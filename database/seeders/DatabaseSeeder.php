<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user dummy
        $user1 = User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@example.com',
            'password' => Hash::make('password123'),
        ]);

        $user2 = User::create([
            'name'     => 'Siti Rahayu',
            'email'    => 'siti@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Buat tugas dummy
        Todo::create([
            'user_id'     => $user1->id,
            'title'       => 'Mengerjakan Laporan Praktikum',
            'description' => 'Buat laporan praktikum BAB 10 tentang Web Framework menggunakan Laravel.',
            'status'      => 'in_progress',
            'due_date'    => now()->addDays(3),
        ]);

        Todo::create([
            'user_id'     => $user1->id,
            'title'       => 'Belajar Blade Template',
            'description' => 'Pahami cara kerja Blade template engine pada Laravel.',
            'status'      => 'completed',
            'due_date'    => now()->subDays(2),
        ]);

        Todo::create([
            'user_id'     => $user2->id,
            'title'       => 'Setup Database MySQL',
            'description' => 'Konfigurasi koneksi database MySQL untuk proyek Laravel.',
            'status'      => 'pending',
            'due_date'    => now()->addDays(1),
        ]);

        Todo::create([
            'user_id'     => $user2->id,
            'title'       => 'Membuat Fitur Autentikasi',
            'description' => 'Implementasi login, register, dan logout tanpa menggunakan package tambahan.',
            'status'      => 'pending',
            'due_date'    => now()->addDays(5),
        ]);
    }
}
