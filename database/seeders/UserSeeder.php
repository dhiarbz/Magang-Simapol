<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama jika ada (optional)
        DB::table('users')->truncate();

        // Data admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // Enkripsi password
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Data user biasa
        DB::table('users')->insert([
            'name' => 'Shifa',
            'email' => 'shifa@example.com',
            'password' => Hash::make('shifa123'),
            'nrp' => '12345678',
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Data dummy tambahan (opsional)
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'nrp' => '12345678',
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}