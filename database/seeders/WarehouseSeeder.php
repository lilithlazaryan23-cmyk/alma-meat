<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    private const STOCK = [
        ['product' => 'Սալյամի Դասական', 'qty' => 45, 'freshness' => 88],
        ['product' => 'Բեկոն Ապխտած', 'qty' => 8, 'freshness' => 55],
        ['product' => 'Պեպերոնի', 'qty' => 22, 'freshness' => 25],
        ['product' => 'Երշիկ Եփած Բարձր Տեսակի', 'qty' => 120, 'freshness' => 97],
        ['product' => 'Գարեջրի Սնեկ Կծու', 'qty' => 2.5, 'freshness' => 64],
    ];

    public function run(): void
    {
        foreach (self::STOCK as $row) {
            $product = Product::where('name', $row['product'])->first();
            if ($product === null) {
                $this->command?->warn("{$row['product']}: product missing, stock skipped");

                continue;
            }
            if (Warehouse::where('product_id', $product->id)->exists()) {
                $this->command?->info("{$row['product']}: stock exists, skipped");

                continue;
            }
            Warehouse::create([
                'product_id' => $product->id,
                'qty' => $row['qty'],
                'freshness' => $row['freshness'],
            ]);
            $this->command?->info("{$row['product']}: stock created");
        }
    }
}
