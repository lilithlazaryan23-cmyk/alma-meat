<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('main');
    }

    public function atenk()
    {
        return view('about.atenk');
    }

    public function luma()
    {
        return view('about.luma');
    }

    public function marila()
    {
        return view('about.marila');
    }

    public function recipes()
    {
        return view('recipes');
    }

    public function cart()
    {
        return view('cart');
    }

    public function checkout(Request $request): JsonResponse
    {
        $items = $request->input('items', []);

        if (! is_array($items) || count($items) === 0) {
            return response()->json(['success' => false, 'message' => 'Զամբյուղը դատարկ է']);
        }

        $created = 0;
        foreach ($items as $item) {
            $product = Product::find((int) ($item['id'] ?? 0));
            $qty = (float) ($item['weight'] ?? 0);

            if ($product === null || $qty <= 0) {
                continue;
            }

            // total is computed from the trusted server-side price, never the client payload
            $unitPrice = $product->sale > 0
                ? $product->price - ($product->price * $product->sale / 100)
                : $product->price;

            Order::create([
                'product_id' => $product->id,
                'qty' => $qty,
                'total_price' => round($qty * $unitPrice),
                'status' => 'pending',
                'source' => 'Կայք',
            ]);
            $created++;
        }

        if ($created === 0) {
            return response()->json(['success' => false, 'message' => 'Վավեր ապրանք չգտնվեց']);
        }

        return response()->json(['success' => true, 'message' => 'Պատվերը ուղարկված է']);
    }
}
