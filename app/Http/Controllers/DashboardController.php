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

                $stockByBrand = Brand::with('products')
            ->get()
            ->map(function ($brand) {

                return [
                    'brand' => $brand->name,
                    'stock' => $brand->products->sum('quantity'),
                ];

            });

        return view('dashboard', [
            'stockByBrand' => $stockByBrand,
            'customersCount' => Customer::count(),
            'productsCount' => Product::count(),
            'brandsCount' => Brand::count(),
            'ordersCount' => Order::count(),
            'prescriptionsCount' => Prescription::count(),
            'totalSales' => Order::sum('total_amount'),
            'lowStockProducts' => Product::whereColumn('quantity', '<=', 'alert_threshold')
                ->orderBy('quantity')
                ->take(3)
                ->get(['name', 'quantity'])
                ->toArray(),
            'salesLabels' => $labels,
            'salesData' => $salesData,
            'ordersLabels' => $labels,
            'ordersData' => $ordersData,
        ]);
    }
}
