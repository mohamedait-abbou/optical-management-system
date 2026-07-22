<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // 1. Handle Date Range  (Default: Last 30 days)
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        // 2. Financials (Fixed: explicitly using 'orders.created_at')
        $financials = Order::whereBetween('orders.created_at', [$startDate, $endDate])
            ->select(
                DB::raw('SUM(orders.total_amount) as total_revenue'),
                DB::raw('COUNT(orders.id) as total_orders'),
                DB::raw('AVG(orders.total_amount) as avg_order_value')
            )
            ->first();

        // Estimate profit (assuming average 40% margin for demonstration)
        $estimatedProfit = $financials->total_revenue ? $financials->total_revenue * 0.40 : 0;

        // 3. Employee Performance (Fixed: explicitly using 'orders.created_at')
        $employeePerformance = Order::whereBetween('orders.created_at', [$startDate, $endDate])
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'users.name',
                DB::raw('COUNT(orders.id) as total_sales'),
                DB::raw('SUM(orders.total_amount) as total_revenue')
            )
            ->groupBy('users.id', 'users.name')
            ->orderBy('total_revenue', 'desc')
            ->get();

        

        // 4. Dead Stock Alert (Products not sold in the last 90 days)
        $deadStock = Product::whereNotIn('id', function($query) {
                $query->select('order_items.product_id')
                      ->from('order_items')
                      ->join('orders', 'order_items.order_id', '=', 'orders.id')
                      ->where('orders.created_at', '>=', Carbon::now()->subDays(90));
            })
            ->where('quantity', '>', 0)
            ->select('name', 'quantity', 'price')
            ->limit(10)
            ->get();

        return view('reports.index', compact(
            'startDate',
            'endDate',
            'financials',
            'estimatedProfit',
            'employeePerformance',
            'deadStock',
        ));
    }
}