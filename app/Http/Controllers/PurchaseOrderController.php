<?php
namespace App\Http\Controllers;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index() {
        $orders = PurchaseOrder::with('supplier')->latest()->paginate(10);
        return view('purchase-orders.index', compact('orders'));
    }

    public function create() {
        $suppliers = Supplier::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        return view('purchase-orders.create', compact('suppliers', 'products'));
    }

    public function store(Request $request) {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.unit_cost' => 'required|numeric|min:0',
        ]);

        $order = PurchaseOrder::create([
            'supplier_id' => $request->supplier_id,
            'order_number' => 'PO-' . now()->format('YmdHis'),
            'order_date' => $request->order_date,
            'expected_date' => $request->expected_date,
            'status' => 'pending',
            'total_amount' => 0,
            'notes' => $request->notes,
        ]);

        $total = 0;
        foreach ($request->products as $item) {
            $subtotal = $item['quantity'] * $item['unit_cost'];
            $total += $subtotal;
            PurchaseOrderItem::create([
                'purchase_order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_cost' => $item['unit_cost'],
                'subtotal' => $subtotal,
            ]);
        }
        $order->update(['total_amount' => $total]);

        return redirect()->route('purchase-orders.index')->with('success', 'Bon de commande créé.');
    }

    public function show(PurchaseOrder $purchaseOrder) {
        $purchaseOrder->load(['supplier', 'items.product']);
        return view('purchase-orders.show', compact('purchaseOrder'));
    }

    // LA MAGIE : Réceptionner le stock
    public function receive(PurchaseOrder $purchaseOrder) {
        if ($purchaseOrder->status !== 'pending') {
            return back()->with('error', 'Ce bon a déjà été traité.');
        }

        DB::transaction(function () use ($purchaseOrder) {
            foreach ($purchaseOrder->items as $item) {
                $product = $item->product;
                if ($product) {
                    // Augmente le stock
                    $product->increment('quantity', $item->quantity);
                    // Met à jour le prix d'achat (optionnel mais recommandé)
                    $product->update(['cost_price' => $item->unit_cost]);
                }
            }
            $purchaseOrder->update(['status' => 'received']);
        });

        return redirect()->route('purchase-orders.show', $purchaseOrder)->with('success', 'Stock réceptionné et mis à jour avec succès !');
    }

    public function destroy(PurchaseOrder $purchaseOrder) {
        if ($purchaseOrder->status !== 'pending') {
            return back()->with('error', 'Impossible de supprimer un bon reçu.');
        }
        $purchaseOrder->delete();
        return redirect()->route('purchase-orders.index')->with('success', 'Bon supprimé.');
    }
}