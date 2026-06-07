<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin ParcelPoint',
            'email' => 'kurniawan.angang2005@gmail.com',
            'password' => Hash::make('ABC#123'), // Ganti password ini
            'role' => 'admin',
        ]);
    }
}
