<?php

namespace Database\Seeders;

use App\Models\AdminAuditLog;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminAuditLogSeeder extends Seeder
{
    public function run(): void
    {
        if (AdminAuditLog::exists()) {
            $this->command?->info('audit logs exist, skipped');

            return;
        }

        foreach (Product::limit(2)->get() as $product) {
            AdminAuditLog::create([
                'admin_user' => 'AtenkAdmin',
                'product_id' => $product->id,
                'hash_name' => Hash::make($product->name),
                'hash_price' => Hash::make((string) $product->price),
                'hash_unit' => Hash::make($product->type),
            ]);
            $this->command?->info("audit log created for product #{$product->id}");
        }
    }
}
