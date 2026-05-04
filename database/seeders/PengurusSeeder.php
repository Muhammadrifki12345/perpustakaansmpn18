<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PengurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'pengurus@perpustakaan.com'],
            [
                'name' => 'Pengurus Perpustakaan',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_approved' => true,
            ]
        );
    }
}
