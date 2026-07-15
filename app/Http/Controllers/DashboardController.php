<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Prescription;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Période des 12 derniers mois pour les graphiques
        $end = Carbon::now()->endOfMonth();
        $start = (clone $end)->subMonths(11)->startOfMonth();

        $period = [];
        $labels = [];
        $cursor = $start->copy();

        while ($cursor->lessThanOrEqualTo($end)) {
            $labels[] = $cursor->translatedFormat('M');
            $period[] = $cursor->format('Y-m');
            $cursor->addMonth();
        }

        // Récupération des données de ventes et commandes par mois
        $rows = DB::table('orders')
            ->select(
                DB::raw("DATE_FORMAT(order_date, '%Y-%m') as ym"),
                DB::raw('SUM(total_amount) as total'),
                DB::raw('COUNT(*) as orders')
            )
            ->whereBetween('order_date', [$start->toDateString(), $end->toDateString()])
            ->groupBy('ym')
            ->orderBy('ym')
            ->get()
            ->keyBy('ym');

        $salesData = [];
        $ordersData = [];

        foreach ($period as $ym) {
            $salesData[] = isset($rows[$ym]) ? (float) $rows[$ym]->total : 0.0;
            $ordersData[] = isset($rows[$ym]) ? (int) $rows[$ym]->orders : 0;
        }

        // Stock par marque
        $stockByBrand = Brand::with('products')
            ->get()
            ->map(function ($brand) {
                return [
                    'brand' => $brand->name ?? 'Inconnue',
                    'stock' => $brand->products->sum('quantity'),
                ];
            });

        // Génération de l'activité récente (Commandes + Prescriptions)
        $recentActivity = [];
        
        $recentOrders = Order::with('customer')->latest()->take(3)->get();
        foreach ($recentOrders as $order) {
            $recentActivity[] = [
                'icon' => 'shopping-cart',
                'color' => 'from-indigo-500 to-blue-500',
                'title' => 'Nouvelle commande',
                'description' => 'Commande #' . $order->order_number . ' pour ' . ($order->customer->first_name ?? 'Client') . ' ' . ($order->customer->last_name ?? ''),
                'time' => $order->created_at->diffForHumans(),
            ];
        }

        $recentPrescriptions = Prescription::with('customer')->latest()->take(2)->get();
        foreach ($recentPrescriptions as $prescription) {
            $recentActivity[] = [
                'icon' => 'clipboard-check',
                'color' => 'from-fuchsia-500 to-pink-500',
                'title' => 'Nouvelle prescription',
                'description' => 'Prescription ajoutée pour ' . ($prescription->customer->first_name ?? 'Client') . ' ' . ($prescription->customer->last_name ?? ''),
                'time' => $prescription->created_at->diffForHumans(),
            ];
        }

        $recentActivity = array_slice($recentActivity, 0, 5);

        // Envoi des données à la vue
        return view('dashboard', [
            'stockByBrand' => $stockByBrand,
            'customersCount' => Customer::count(),
            'productsCount' => Product::count(),
            'brandsCount' => Brand::count(),
            'ordersCount' => Order::count(),
            'prescriptionsCount' => Prescription::count(),
            'totalSales' => Order::sum('total_amount') ?? 0,
            'lowStockProducts' => Product::whereColumn('quantity', '<=', 'alert_threshold')
                ->orderBy('quantity')
                ->take(3)
                ->get(['name', 'quantity'])
                ->toArray(),
            'salesLabels' => $labels,
            'salesData' => $salesData,
            'ordersLabels' => $labels,
            'ordersData' => $ordersData,
            'recentActivity' => $recentActivity,
        ]);
    }
}