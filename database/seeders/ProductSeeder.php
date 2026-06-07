<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public const PRODUCTS = [
        ['name' => 'Սալյամի Դասական', 'img' => 'images/products/salyami-removebg-preview.png', 'category' => 'Ապխտած Մսամթերք', 'brand' => 'Աթենք', 'type' => 'KG', 'recept' => 'Տավարի միս, աղ, համեմունքներ', 'price' => 4800, 'sale' => 15, 'liked' => 1],
        ['name' => 'Բեկոն Ապխտած', 'img' => 'images/products/բեկոն-removebg-preview.png', 'category' => 'Ապխտած Մսամթերք', 'brand' => 'Մարիլա', 'type' => 'KG', 'recept' => 'Խոզի միս, աղ', 'price' => 5200, 'sale' => 0, 'liked' => 0],
        ['name' => 'Պեպերոնի', 'img' => 'images/products/պեպերոնի-removebg-preview.png', 'category' => 'Բաստուրմա,Սուջուխ', 'brand' => 'Լումա', 'type' => 'pice', 'recept' => 'Տավարի միս, պղպեղ', 'price' => 3500, 'sale' => 0, 'liked' => 1],
        ['name' => 'Նրբերշիկ Հավի', 'img' => 'images/products/ֆիլե-removebg-preview.png', 'category' => 'Նրբերշիկ և սարդելկա', 'brand' => 'Աթենք', 'type' => 'pice', 'recept' => 'Հավի միս, կաթ', 'price' => 1650, 'sale' => 25, 'liked' => 0],
        ['name' => 'Երշիկ Եփած Բարձր Տեսակի', 'img' => 'images/products/salyami-removebg-preview.png', 'category' => 'Եփած Մսամթերք', 'brand' => 'Մարիլա', 'type' => 'KG', 'recept' => 'Տավարի միս, կաթ, ձու', 'price' => 3900, 'sale' => 0, 'liked' => 0],
        ['name' => 'Գարեջրի Սնեկ Կծու', 'img' => 'images/products/պեպերոնի-removebg-preview.png', 'category' => 'Գարեջրի Նախուտեստներ', 'brand' => 'Atenk', 'type' => 'pice', 'recept' => 'Տավարի միս, կծու պղպեղ', 'price' => 2100, 'sale' => 10, 'liked' => 0],
    ];

    public function run(): void
    {
        foreach (self::PRODUCTS as $product) {
            if (Product::where('name', $product['name'])->exists()) {
                $this->command?->info("{$product['name']}: exists, skipped");

                continue;
            }
            Product::create($product);
            $this->command?->info("{$product['name']}: created");
        }
    }
}
