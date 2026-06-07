<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $filter = trim((string) $request->query('filter', ''));

        $query = Product::query();

        if ($filter !== '') {
            if ($filter == 'հավանածներ') {
                $query->where('liked', 1);
            } elseif ($filter == 'sale') {
                $query->where('sale', '>', 0);
            } else {
                $query->where('category', $filter);
            }
        }

        if ($search !== '') {
            $like = '%'.$search.'%';
            $query->where(function ($w) use ($like) {
                $w->where('name', 'LIKE', $like)
                    ->orWhere('recept', 'LIKE', $like)
                    ->orWhere('category', 'LIKE', $like)
                    ->orWhereRaw("COALESCE(`brand`, '') LIKE ?", [$like]);
            });
        }

        $products = $query->get();

        return view('products.index', [
            'products' => $products,
            'search' => $search,
        ]);
    }

    public function like(Request $request)
    {
        if ($request->has('heart_id')) {
            $product = Product::find($request->post('heart_id'));

            $newLike = ((int) ($product->liked ?? 0)) === 0 ? 1 : 0;

            if ($product !== null) {
                $product->liked = $newLike;
                $product->save();
            }

            return response($newLike === 1 ? 'red' : 'silver');
        }

        return response('');
    }
}
