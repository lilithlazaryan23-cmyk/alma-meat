<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private const USERS = [
        ['name' => 'Անի Գրիգորյան', 'email' => 'ani@alma.local', 'username' => 'anigrig', 'password' => 'User@2026', 'gender' => 'female'],
        ['name' => 'Կարեն Սարգսյան', 'email' => 'karen@alma.local', 'username' => 'karens', 'password' => 'User@2026', 'gender' => 'male'],
    ];

    public function run(): void
    {
        foreach (self::USERS as $user) {
            if (User::where('email', $user['email'])->orWhere('username', $user['username'])->exists()) {
                $this->command?->info("{$user['email']}: exists, skipped");

                continue;
            }

            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'username' => $user['username'],
                'password' => Hash::make($user['password']),
                'gender' => $user['gender'],
            ]);
            $this->command?->info("{$user['email']}: created");
        }
    }
}
