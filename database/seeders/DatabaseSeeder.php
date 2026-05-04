<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use \Illuminate\Database\Console\Seeds\WithoutModelEvents;

    public function run(): void
    {
        // 0. Call Other Seeders
        $this->call([
            SettingSeeder::class,
            PengurusSeeder::class,
        ]);

        // 1. Super Admin (Full Control)
        User::updateOrCreate(
            ['email' => 'superadmin@perpustakaan.com'],
            [
                'name'  => 'Super Admin Utama',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role'  => 'superadmin',
                'phone' => '081122334455',
                'is_approved' => true,
            ]
        );

        // 2. Pengurus (Operational Admin)
        User::updateOrCreate(
            ['email' => 'admin@perpustakaan.com'],
            [
                'name'  => 'Pengurus Perpus',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role'  => 'admin',
                'phone' => '081234567890',
                'is_approved' => true,
            ]
        );

        $siswa = User::updateOrCreate(
            ['email' => 'siswa@perpustakaan.com'],
            [
                'name'  => 'Budi Santoso',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role'  => 'siswa',
                'phone' => '089876543210',
                'is_approved' => true,
            ]
        );

        $siswa2 = User::updateOrCreate(
            ['email' => 'sari@perpustakaan.com'],
            [
                'name'  => 'Sari Dewi',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role'  => 'siswa',
                'phone' => '081111222333',
                'is_approved' => true,
            ]
        );

        // Categories
        $fiksi    = \App\Models\Category::updateOrCreate(['name' => 'Fiksi & Novel'],      ['description' => 'Karya fiksi dan novel']);
        $sains    = \App\Models\Category::updateOrCreate(['name' => 'Sains & Teknologi'],  ['description' => 'Ilmu pengetahuan & teknologi']);
        $sejarah  = \App\Models\Category::updateOrCreate(['name' => 'Sejarah & Budaya'],   ['description' => 'Sejarah & budaya nusantara']);
        $bisnis   = \App\Models\Category::updateOrCreate(['name' => 'Bisnis & Ekonomi'],   ['description' => 'Buku bisnis dan keuangan']);
        $self     = \App\Models\Category::updateOrCreate(['name' => 'Pengembangan Diri'],  ['description' => 'Self-help & motivasi']);

        // Shelves (Rak Buku)
        $rakA = \App\Models\Shelf::updateOrCreate(['name' => 'Rak A - Fiksi'], ['location_code' => 'A-01', 'description' => 'Rak untuk buku fiksi dan novel']);
        $rakB = \App\Models\Shelf::updateOrCreate(['name' => 'Rak B - Non-Fiksi'], ['location_code' => 'B-01', 'description' => 'Rak untuk buku non-fiksi, sains, dan sejarah']);
        $rakC = \App\Models\Shelf::updateOrCreate(['name' => 'Rak C - Referensi'], ['location_code' => 'C-01', 'description' => 'Rak untuk buku referensi dan pengembangan diri']);

        // Books
        $buku1 = \App\Models\Book::updateOrCreate(
            ['barcode' => 'BK-001'],
            [
                'title'       => 'Laskar Pelangi',
                'author'      => 'Andrea Hirata',
                'publisher'   => 'Bentang Pustaka',
                'year'        => 2005,
                'category_id' => $fiksi->id,
                'shelf_id'    => $rakA->id,
                'stock'       => 2,
                'borrow_count'=> 48,
                'file_path'   => 'dummy_ebook.pdf',
                'cover_image' => 'covers/laskar-pelangi.png',
            ]
        );

        $buku2 = \App\Models\Book::updateOrCreate(
            ['barcode' => 'BK-002'],
            [
                'title'       => 'Belajar Laravel 11',
                'author'      => 'Taylor Otwell',
                'publisher'   => 'IT Pustaka',
                'year'        => 2024,
                'category_id' => $sains->id,
                'stock'       => 3,
                'borrow_count'=> 21,
                'file_path'   => 'dummy_ebook.pdf',
                'cover_image' => 'covers/laravel-11.png',
            ]
        );

        $buku3 = \App\Models\Book::updateOrCreate(
            ['barcode' => 'BK-003'],
            [
                'title'       => 'Filosofi Teras',
                'author'      => 'Henry Manampiring',
                'publisher'   => 'Kompas',
                'year'        => 2018,
                'category_id' => $self->id,
                'stock'       => 1,
                'file_path'   => null,
                'cover_image' => null,
            ]
        );

        $buku4 = \App\Models\Book::updateOrCreate(
            ['barcode' => 'BK-004'],
            [
                'title'       => 'Sapiens: Riwayat Singkat Umat Manusia',
                'author'      => 'Yuval Noah Harari',
                'publisher'   => 'KPG',
                'year'        => 2017,
                'category_id' => $sejarah->id,
                'stock'       => 2,
                'file_path'   => null,
                'cover_image' => null,
            ]
        );

        $buku5 = \App\Models\Book::updateOrCreate(
            ['barcode' => 'BK-005'],
            [
                'title'       => 'Rich Dad Poor Dad',
                'author'      => 'Robert T. Kiyosaki',
                'publisher'   => 'Gramedia',
                'year'        => 2021,
                'category_id' => $bisnis->id,
                'stock'       => 0,
                'file_path'   => null,
                'cover_image' => null,
            ]
        );

        $buku6 = \App\Models\Book::updateOrCreate(
            ['barcode' => 'BK-006'],
            [
                'title'       => 'Bumi Manusia',
                'author'      => 'Pramoedya Ananta Toer',
                'publisher'   => 'Hasta Mitra',
                'year'        => 1980,
                'category_id' => $fiksi->id,
                'stock'       => 1,
                'file_path'   => null,
                'cover_image' => null,
            ]
        );

        // Ratings
        \App\Models\Rating::updateOrCreate(['user_id' => $siswa->id,  'book_id' => $buku1->id], ['rating' => 5, 'review' => 'Sangat inspiratif! Wajib dibaca oleh semua orang.']);
        \App\Models\Rating::updateOrCreate(['user_id' => $siswa2->id, 'book_id' => $buku1->id], ['rating' => 5, 'review' => 'Kisah yang mengharukan dan penuh semangat.']);
        \App\Models\Rating::updateOrCreate(['user_id' => $siswa->id,  'book_id' => $buku3->id], ['rating' => 4, 'review' => 'Pandangan hidup Stoik yang relevan untuk hari ini.']);

        // Follows
        \App\Models\Follow::firstOrCreate(['user_id' => $siswa->id,  'followed_id' => $siswa2->id]);
        \App\Models\Follow::firstOrCreate(['user_id' => $siswa2->id, 'followed_id' => $siswa->id]);

        // Activities (Feed)
        \App\Models\Activity::updateOrCreate(
            ['user_id' => $siswa->id, 'type' => 'borrowed', 'created_at' => now()->subHours(3)->format('Y-m-d H:i:s')],
            ['details' => ['book_id' => $buku1->id, 'title' => $buku1->title]]
        );
        \App\Models\Activity::updateOrCreate(
            ['user_id' => $siswa2->id, 'type' => 'reviewed', 'created_at' => now()->subHour()->format('Y-m-d H:i:s')],
            ['details' => ['book_id' => $buku1->id, 'rating' => 5, 'text' => 'Kisah yang mengharukan dan penuh semangat.']]
        );

        // Loans
        \App\Models\Loan::updateOrCreate(
            ['invoice_number' => 'INV-20260428-001'],
            [
                'user_id'              => $siswa->id,
                'book_id'              => $buku1->id,
                'loan_date'            => now()->subDays(2),
                'expected_return_date' => now()->addDays(5),
                'actual_return_date'   => null,
                'status'               => 'borrowed',
                'is_late'              => false,
            ]
        );

        // Waitlist
        \App\Models\Waitlist::updateOrCreate(
            ['user_id' => $siswa2->id, 'book_id' => $buku5->id],
            ['status'  => 'waiting']
        );
    }
}
