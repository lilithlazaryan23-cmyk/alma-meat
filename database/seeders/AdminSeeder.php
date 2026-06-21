<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    private const ADMINS = [
        ['name' => 'AtenkAdmin', 'email' => 'atenk@admin.local', 'password' => 'Atenk@2026'],
        ['name' => 'MarilaAdmin', 'email' => 'marila@admin.local', 'password' => 'Marila@2026'],
        ['name' => 'LumaAdmin', 'email' => 'luma@admin.local', 'password' => 'Luma@2026'],
    ];

    public function run(): void
    {
        foreach (self::ADMINS as $admin) {
            $username = preg_replace('/[^a-z0-9]/', '', strtolower($admin['name']));

            if (Admin::where('email', $admin['email'])->orWhere('username', $username)->exists()) {
                $this->command?->info("{$admin['email']}: exists, skipped");

                continue;
            }

            Admin::create([
                'name' => $admin['name'],
                'email' => $admin['email'],
                'username' => $username,
                'password' => Hash::make($admin['password']),
            ]);
            $this->command?->info("{$admin['email']}: created");
        }
    }
}
