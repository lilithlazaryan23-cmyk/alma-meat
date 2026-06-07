<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));
        $brand = trim((string) $request->query('brand', ''));

        $query = DB::table('products as p')
            ->leftJoin('warehouses as w', 'w.product_id', '=', 'p.id')
            ->selectRaw("p.id, p.name, p.type, COALESCE(p.brand, '') AS brand,
                         COALESCE(SUM(w.qty), 0) AS qty,
                         COALESCE(AVG(w.freshness), 0) AS freshness");

        if ($brand !== '') {
            $query->where('p.brand', $brand);
        }
        if ($search !== '') {
            $query->where('p.name', 'LIKE', '%'.$search.'%');
        }

        $rows = $query->groupBy('p.id')->get();

        return view('admin.warehouse', [
            'rows' => $rows,
            'search' => $search,
            'brand' => $brand,
        ]);
    }
}
