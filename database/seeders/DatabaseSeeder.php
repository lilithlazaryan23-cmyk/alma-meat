<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
            WarehouseSeeder::class,
            OrderSeeder::class,
            AdminAuditLogSeeder::class,
        ]);
    }
}
