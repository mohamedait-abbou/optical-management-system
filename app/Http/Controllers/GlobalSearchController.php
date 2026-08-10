<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Prescription;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Reservation;
use App\Models\Supplier;
use Illuminate\Http\Request;

class GlobalSearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        if (mb_strlen($q) < 2) {
            return response()->json(['results' => []]);
        }

        $user = $request->user();
        $can = fn (string $permission) => $user->can($permission);

        $results = [];

        if ($can('customers.view')) {
            foreach (Customer::where('first_name', 'like', "%{$q}%")
                ->orWhere('last_name', 'like', "%{$q}%")
                ->orWhere('cin', 'like', "%{$q}%")
                ->orWhere('phone', 'like', "%{$q}%")
                ->orWhere('email', 'like', "%{$q}%")
                ->limit(5)->get() as $customer) {
                $results[] = [
                    'group' => __('Customers'),
                    'title' => trim($customer->first_name.' '.$customer->last_name),
                    'subtitle' => $customer->cin ?: ($customer->phone ?: $customer->email),
                    'url' => route('customers.show', $customer),
                ];
            }
        }

        if ($can('products.view')) {
            foreach (Product::where('name', 'like', "%{$q}%")->limit(5)->get() as $product) {
                $results[] = [
                    'group' => __('Products'),
                    'title' => $product->name,
                    'subtitle' => optional($product->brand)->name ?? '',
                    'url' => route('products.show', $product),
                ];
            }
        }

        if ($can('orders.view')) {
            foreach (Order::with('customer')->where('order_number', 'like', "%{$q}%")->limit(5)->get() as $order) {
                $customerName = $order->customer ? trim($order->customer->first_name.' '.$order->customer->last_name) : '';
                $results[] = [
                    'group' => __('Orders'),
                    'title' => $order->order_number,
                    'subtitle' => $customerName,
                    'url' => route('orders.show', $order),
                ];
            }
        }

        if ($can('invoices.view')) {
            foreach (Invoice::with('order.customer')->where('invoice_number', 'like', "%{$q}%")->limit(5)->get() as $invoice) {
                $customerName = $invoice->order?->customer ? trim($invoice->order->customer->first_name.' '.$invoice->order->customer->last_name) : '';
                $results[] = [
                    'group' => __('Invoices'),
                    'title' => $invoice->invoice_number,
                    'subtitle' => $customerName,
                    'url' => route('invoices.show', $invoice),
                ];
            }
        }

        if ($can('suppliers.view')) {
            foreach (Supplier::where('name', 'like', "%{$q}%")
                ->orWhere('contact_name', 'like', "%{$q}%")
                ->orWhere('phone', 'like', "%{$q}%")
                ->limit(5)->get() as $supplier) {
                $results[] = [
                    'group' => __('Suppliers'),
                    'title' => $supplier->name,
                    'subtitle' => $supplier->contact_name ?? $supplier->phone,
                    'url' => route('suppliers.edit', $supplier),
                ];
            }
        }

        if ($can('reservations.view')) {
            foreach (Reservation::with('customer')
                ->where('reason', 'like', "%{$q}%")
                ->orWhereHas('customer', fn ($query) => $query->where('first_name', 'like', "%{$q}%")->orWhere('last_name', 'like', "%{$q}%"))
                ->limit(5)->get() as $reservation) {
                $customerName = $reservation->customer ? trim($reservation->customer->first_name.' '.$reservation->customer->last_name) : '';
                $results[] = [
                    'group' => __('Reservations'),
                    'title' => $reservation->reason ?: __('Reservation'),
                    'subtitle' => $customerName ?: $reservation->reservation_date?->format('d/m/Y'),
                    'url' => route('reservations.show', $reservation),
                ];
            }
        }

        if ($can('prescriptions.view')) {
            foreach (Prescription::with('customer')
                ->where('doctor_name', 'like', "%{$q}%")
                ->orWhereHas('customer', fn ($query) => $query->where('first_name', 'like', "%{$q}%")->orWhere('last_name', 'like', "%{$q}%"))
                ->limit(5)->get() as $prescription) {
                $customerName = $prescription->customer ? trim($prescription->customer->first_name.' '.$prescription->customer->last_name) : '';
                $results[] = [
                    'group' => __('Prescriptions'),
                    'title' => __('Prescription').' #'.$prescription->id,
                    'subtitle' => $prescription->doctor_name ?: $customerName,
                    'url' => route('prescriptions.show', $prescription),
                ];
            }
        }

        if ($can('brands.view')) {
            foreach (Brand::where('name', 'like', "%{$q}%")->limit(3)->get() as $brand) {
                $results[] = [
                    'group' => __('Brands'),
                    'title' => $brand->name,
                    'subtitle' => '',
                    'url' => route('brands.show', $brand),
                ];
            }
        }

        if ($can('categories.view')) {
            foreach (Category::where('name', 'like', "%{$q}%")->limit(3)->get() as $category) {
                $results[] = [
                    'group' => __('Categories'),
                    'title' => $category->name,
                    'subtitle' => '',
                    'url' => route('categories.edit', $category),
                ];
            }
        }

        if ($can('purchase-orders.view')) {
            foreach (PurchaseOrder::where('order_number', 'like', "%{$q}%")->limit(3)->get() as $po) {
                $results[] = [
                    'group' => __('Purchase Orders'),
                    'title' => $po->order_number,
                    'subtitle' => optional($po->supplier)->name ?? '',
                    'url' => route('purchase-orders.show', $po),
                ];
            }
        }

        return response()->json([
            'results' => collect($results)->sortBy('group')->values(),
        ]);
    }
}
