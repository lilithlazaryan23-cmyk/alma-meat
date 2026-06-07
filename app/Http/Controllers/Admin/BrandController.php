<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    private const AVAILABLE_BRANDS = [
        'atenk' => 'Աթենք',
        'marila' => 'Մարիլա',
        'luma' => 'Լումա',
    ];

    public function index(Request $request)
    {
        $brandKey = trim(strtolower((string) $request->query('brand', 'atenk')));
        if (! isset(self::AVAILABLE_BRANDS[$brandKey])) {
            $brandKey = 'atenk';
        }
        $brandLabel = self::AVAILABLE_BRANDS[$brandKey];
        $search = trim((string) $request->query('search', ''));

        $query = DB::table('products as p')
            ->leftJoin('warehouses as w', 'w.product_id', '=', 'p.id')
            ->selectRaw("p.id, p.name, p.category, p.type, COALESCE(p.brand, '') AS brand,
                         COALESCE(SUM(w.qty), 0) AS qty,
                         COALESCE(AVG(w.freshness), 0) AS freshness,
                         p.price, p.sale")
            ->where('p.brand', $brandLabel);

        if ($search !== '') {
            $like = '%'.$search.'%';
            $query->where(function ($w) use ($like) {
                $w->where('p.name', 'LIKE', $like)
                    ->orWhere('p.recept', 'LIKE', $like)
                    ->orWhere('p.category', 'LIKE', $like);
            });
        }

        $rows = $query->groupBy('p.id')->orderByDesc('p.id')->get();

        $lowStockCount = $rows->filter(fn ($row) => (float) $row->qty < 10)->count();

        return view('admin.brand', [
            'rows' => $rows,
            'brandKey' => $brandKey,
            'brandLabel' => $brandLabel,
            'search' => $search,
            'lowStockCount' => $lowStockCount,
            'totalItems' => $rows->count(),
        ]);
    }
}
