<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Buat akun admin jika belum ada
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin3205@gmail.com',
                'password' => Hash::make('garutkab3205'),
                'role' => 'admin',
                'account_limit' => null,
                'accounts_created' => 0,
            ]);
        }

        // Array untuk menyimpan user yang akan dibuat
        $users = [
            [
                'name' => 'PPK 3205',
                'email' => 'ppk3205@gmail.com',
                'password' => 'garutkab3205'
            ],
            [
                'name' => 'Umum 3205',
                'email' => 'umum3205@gmail.com',
                'password' => 'garutkab3205'
            ],
            [
                'name' => 'Sosial 3205',
                'email' => 'sosial3205@gmail.com',
                'password' => 'garutkab3205'
            ],
            [
                'name' => 'Produksi 3205',
                'email' => 'produksi3205@gmail.com',
                'password' => 'garutkab3205'
            ],
            [
                'name' => 'Distribusi 3205',
                'email' => 'distribusi3205@gmail.com',
                'password' => 'garutkab3205'
            ],
            [
                'name' => 'Nerwilis 3205',
                'email' => 'nerwilis3205@gmail.com',
                'password' => 'garutkab3205'
            ],
            [
                'name' => 'IPDS 3205',
                'email' => 'ipds3205@gmail.com',
                'password' => 'garutkab3205'
            ],
        ];

        // Buat user baru hanya jika belum ada
        foreach ($users as $userData) {
            if (!User::where('email', $userData['email'])->exists()) {
                User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'role' => 'user',
                    'account_limit' => 7,
                    'accounts_created' => 0,
                ]);
            }
        }
    }
}