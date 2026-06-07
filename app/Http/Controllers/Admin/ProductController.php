<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminAuditLog;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    private function clean(string $v): string
    {
        return htmlspecialchars(stripslashes(trim($v)));
    }

    private function storeProductImage(UploadedFile $img, array $allowed): string
    {
        $ext = strtolower($img->getClientOriginalExtension());

        if ($ext === '' || ! in_array($ext, $allowed, true) || @getimagesize($img->getPathname()) === false) {
            throw new \RuntimeException('invalid image');
        }

        $name = time().'_'.bin2hex(random_bytes(4)).'.'.$ext;
        $img->storeAs('uploads/products', $name, 'public');

        return 'uploads/products/'.$name;
    }

    public function list(Request $request)
    {
        $brand = trim((string) $request->query('brand', ''));

        $query = Product::query();
        if ($brand !== '') {
            $query->where('brand', $brand);
        }

        return view('admin.products-list', [
            'rows' => $query->orderByDesc('id')->get(),
            'brand' => $brand,
        ]);
    }

    public function addForm(Request $request)
    {
        return view('admin.add-product', [
            'okMsg' => (string) $request->query('ok', ''),
            'errMsg' => (string) $request->query('err', ''),
        ]);
    }

    private function back(string $key, string $msg): RedirectResponse
    {
        return redirect()->route('admin.products.add', [$key => $msg]);
    }

    public function store(Request $request): RedirectResponse
    {
        $name = $this->clean((string) $request->post('name', ''));
        $category = $this->clean((string) $request->post('category', ''));
        $brand = $this->clean((string) $request->post('brand', ''));
        $type = $this->clean((string) $request->post('type', ''));
        $recept = $this->clean((string) $request->post('recept', ''));
        $price = (float) $request->post('price', 0);
        $sale = $request->post('sale') !== null && $request->post('sale') !== '' ? (int) $request->post('sale') : 0;
        $sale = max(0, min(100, $sale));

        if ($name === '' || $category === '' || $brand === '' || $type === '' || $recept === '' || $price <= 0) {
            return $this->back('err', 'Լրացրեք բոլոր պարտադիր դաշտերը');
        }

        $img = $request->file('img');
        if ($img === null || ! $img->isValid()) {
            return $this->back('err', 'Նկարը պարտադիր է');
        }

        try {
            $fileName = $this->storeProductImage($img, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
        } catch (\Throwable) {
            return $this->back('err', 'Թույլատրվում է միայն jpg/png/gif/webp');
        }

        try {
            Product::create([
                'name' => $name,
                'img' => $fileName,
                'category' => $category,
                'brand' => $brand,
                'type' => $type,
                'recept' => $recept,
                'price' => $price,
                'sale' => $sale,
            ]);
        } catch (\Throwable) {
            return $this->back('err', 'Չհաջողվեց պահպանել');
        }

        return $this->back('ok', 'Ապրանքը հաջողությամբ ավելացվեց');
    }

    public function search(Request $request): JsonResponse
    {
        $q = trim((string) $request->query('q', ''));
        $brand = trim((string) $request->query('brand', ''));

        $query = Product::query()->select('id', 'name', 'category', 'price', 'type', 'brand');

        if ($q !== '') {
            $like = '%'.$q.'%';
            $query->where(function ($w) use ($like) {
                $w->where('name', 'LIKE', $like)
                    ->orWhere('category', 'LIKE', $like)
                    ->orWhere('recept', 'LIKE', $like);
            });
        }
        if ($brand !== '') {
            $query->where('brand', $brand);
        }

        $out = $query->orderByDesc('id')->limit(200)->get()->map(fn ($row) => [
            'id' => $row->id,
            'name' => $row->name,
            'category' => $row->category,
            'price' => $row->price,
            'type' => $row->type,
            'brand' => $row->brand ?? '',
        ]);

        return response()->json($out);
    }

    public function storeAjax(Request $request): JsonResponse
    {
        $adminUser = session('User', 'unknown');

        $name = trim((string) $request->post('name', ''));
        $category = trim((string) $request->post('category', ''));
        $unit = trim((string) $request->post('unit', ''));
        $price = trim((string) $request->post('price', ''));
        $sale = $request->post('sale') !== null ? (int) $request->post('sale') : 0;
        $sale = max(0, min(100, $sale));
        $announcement = trim((string) $request->post('announcement', ''));
        $brand = trim((string) $request->post('brand', ''));

        if ($name === '' || $price === '' || $unit === '') {
            return response()->json(['success' => false, 'message' => 'Խնդրում ենք լրացնել Անվանումը, Գինը և Չափման Միավորը']);
        }

        if (! is_numeric(str_replace([',', ' '], '', $price))) {
            return response()->json(['success' => false, 'message' => 'Գինը պետք է թվային լինի']);
        }

        $imgName = '';
        $img = $request->file('img');
        if ($img !== null && $img->isValid()) {
            try {
                $imgName = $this->storeProductImage($img, ['jpg', 'jpeg', 'png', 'gif']);
            } catch (\Throwable) {
                return response()->json(['success' => false, 'message' => 'Թույլատրվում են միայն image ֆայլեր']);
            }
        }

        try {
            $product = Product::create([
                'name' => $name,
                'img' => $imgName,
                'category' => $category,
                'type' => $unit,
                'recept' => $announcement,
                'price' => (float) $price,
                'sale' => $sale,
                'brand' => $brand,
            ]);
        } catch (\Throwable) {
            return response()->json(['success' => false, 'message' => 'Ապրանքը չի պահպանվել']);
        }

        try {
            AdminAuditLog::create([
                'admin_user' => $adminUser,
                'product_id' => $product->id,
                'hash_name' => Hash::make($name),
                'hash_price' => Hash::make((string) $price),
                'hash_unit' => Hash::make($unit),
            ]);
        } catch (\Throwable) {
        }

        return response()->json(['success' => true, 'message' => 'Ապրանքը հաջողությամբ պահպանվեց']);
    }
}
