<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    private const ORDERS = [
        ['product' => 'Սալյամի Դասական', 'qty' => 12.5, 'total_price' => 60000, 'status' => 'pending', 'source' => 'Երևան Սիթի', 'days_ago' => 0],
        ['product' => 'Բեկոն Ապխտած', 'qty' => 30, 'total_price' => 156000, 'status' => 'delivered', 'source' => 'Կարֆուր', 'days_ago' => 2],
        ['product' => 'Պեպերոնի', 'qty' => 5, 'total_price' => 17500, 'status' => 'cancelled', 'source' => 'SAS Group', 'days_ago' => 1],
        ['product' => 'Երշիկ Եփած Բարձր Տեսակի', 'qty' => 18, 'total_price' => 70200, 'status' => 'shipped', 'source' => 'Նոր Զովք', 'days_ago' => 0],
    ];

    public function run(): void
    {
        foreach (self::ORDERS as $row) {
            $product = Product::where('name', $row['product'])->first();
            if ($product === null) {
                $this->command?->warn("{$row['product']}: product missing, order skipped");

                continue;
            }
            $exists = Order::where('product_id', $product->id)
                ->where('total_price', $row['total_price'])
                ->exists();
            if ($exists) {
                $this->command?->info("{$row['product']}: order exists, skipped");

                continue;
            }
            Order::create([
                'product_id' => $product->id,
                'qty' => $row['qty'],
                'total_price' => $row['total_price'],
                'status' => $row['status'],
                'source' => $row['source'],
                'created_at' => now()->subDays($row['days_ago']),
            ]);
            $this->command?->info("{$row['product']}: order created ({$row['status']})");
        }
    }
}
