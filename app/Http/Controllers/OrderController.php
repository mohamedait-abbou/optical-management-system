<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\User;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $orders = Order::with('customer', 'user')
            ->when($search, function ($query) use ($search) {
                $query->where('order_number', 'like', "%{$search}%")
                      ->orWhereHas('customer', function ($q) use ($search) {
                          $q->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                      });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('orders.index', compact('orders', 'search'));
    }

    public function create()
    {
        $customers = Customer::orderBy('first_name')->get();
        $products = Product::orderBy('name')->get();

        return view('orders.create', compact('customers', 'products'));
    }

        public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . now()->format('YmdHis'),
            'order_date' => $request->order_date,
            'status' => $request->status,
            'total_amount' => 0,
            'notes' => $request->notes,
        ]);

        $this->saveOrderItems($order, $request->products, $request->quantities);
      
        // ✅ MODIFICATION ICI : Notifie directement l'utilisateur connecté
        $customerName = $order->customer ? ($order->customer->first_name . ' ' . $order->customer->last_name) : 'Client';
        Auth::user()->notify(new NewOrderNotification($order->order_number, $customerName));

        return redirect()
            ->route('orders.index')
            ->with('success', 'Commande créée avec succès.');
    }

    public function show(Order $order)
    {
        $order->load('customer', 'user', 'payments');

        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::orderBy('first_name')->get();
        $products = Product::orderBy('name')->get();

        return view('orders.edit', compact('order', 'customers', 'products'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update([
            'customer_id' => $request->customer_id,
            'order_date' => $request->order_date,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        $this->saveOrderItems($order, $request->products, $request->quantities);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Commande mise à jour avec succès.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Commande supprimée avec succès.');
    }

    protected function saveOrderItems(Order $order, array $productIds, array $quantities): void
    {
        $order->items()->delete();

        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');
        $totalAmount = 0;

        foreach ($productIds as $index => $productId) {
            $quantity = intval($quantities[$index] ?? 0);

            if ($quantity < 1 || !isset($products[$productId])) {
                continue;
            }

            $unitPrice = $products[$productId]->price;
            $subtotal = $unitPrice * $quantity;

            $order->items()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
            ]);

            $totalAmount += $subtotal;
        }

        $order->update(['total_amount' => $totalAmount]);
    }
}