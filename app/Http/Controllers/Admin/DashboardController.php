<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAssortment = Product::count();
        $salesCount = Product::where('sale', '>', 0)->count();

        $dailyOrders = DB::table('orders')->whereDate('created_at', date('Y-m-d'))->count();
        $monthlyRevenue = (float) DB::table('orders')
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('n'))
            ->sum('total_price');

        $lowStockCount = DB::table('products as p')
            ->leftJoin('warehouses as w', 'w.product_id', '=', 'p.id')
            ->selectRaw('p.id, COALESCE(SUM(w.qty), 0) AS qty')
            ->groupBy('p.id')
            ->havingRaw('qty < 10')
            ->get()
            ->count();

        $logistics = DB::table('orders as o')
            ->leftJoin('products as p', 'p.id', '=', 'o.product_id')
            ->select('o.id', 'o.qty', 'o.total_price', 'o.status', 'o.source', 'p.name', 'p.type')
            ->orderByDesc('o.created_at')
            ->limit(10)
            ->get();

        $armenianMonths = [1 => 'Հունվարի', 2 => 'Փետրվարի', 3 => 'Մարտի', 4 => 'Ապրիլի', 5 => 'Մայիսի', 6 => 'Հունիսի',
            7 => 'Հուլիսի', 8 => 'Օգոստոսի', 9 => 'Սեպտեմբերի', 10 => 'Հոկտեմբերի', 11 => 'Նոյեմբերի', 12 => 'Դեկտեմբերի'];
        $todayLabel = (int) date('j').' '.$armenianMonths[(int) date('n')].', '.date('Y').' թ.';

        return view('admin.dashboard', [
            'totalAssortment' => $totalAssortment,
            'salesCount' => $salesCount,
            'dailyOrders' => $dailyOrders,
            'monthlyRevenue' => $monthlyRevenue,
            'lowStockCount' => $lowStockCount,
            'logistics' => $logistics,
            'todayLabel' => $todayLabel,
        ]);
    }
}
