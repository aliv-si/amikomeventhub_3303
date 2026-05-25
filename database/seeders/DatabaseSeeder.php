<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Utama

        \App\Models\User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 2. Insert Kategori Event

        $category = \App\Models\Category::firstOrCreate([
            'name' => 'Seminar',
            'slug' => 'seminar',
        ]);

        $category2 = \App\Models\Category::firstOrCreate([
            'name' => 'Workshop',
            'slug' => 'workshop',
        ]);

        $category3 = \App\Models\Category::firstOrCreate([
            'name' => 'Entertainment',
            'slug' => 'entertainment',
        ]);

        $category4 = \App\Models\Category::firstOrCreate([
            'name' => 'Competition',
            'slug' => 'competition',
        ]);

        // 3. Insert Sampel Events

        \App\Models\Event::create([
            'category_id' => $category3->id,
            'title' => 'Jazz Night 2025',
            'description' => 'Nikmati malam yang indah dengan alunan musik jazz yang merdu.',
            'date' => '2026-05-10 19:00:00',
            'location' => 'Amikom Baru',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-jazz.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category4->id,
            'title' => 'Hackaton - Unleash Your Inner Developer',
            'description' => 'Ayo asah skill coding kamu dan ciptakan solusi inovatif untuk tantangan masa depan!',
            'date' => '2026-05-05 10:00:00',
            'location' => 'Zoom Meeting',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-hackathon.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category->id,
            'title' => 'AI & Future: Unleash The Power',
            'description' => 'Temui AI di garis depan! Pelajari bagaimana kecerdasan buatan membentuk masa depan kita—mulai dari otomatisasi pintar hingga kreasi yang belum pernah ada sebelumnya.',
            'date' => '2026-06-15 10:00:00',
            'location' => 'Cinema Amikom',
            'price' => 75000,
            'stock' => 100,
            'poster_path' => 'posters/event-ai.png',
        ]);

        // \App\Models\Event::create([
        //     'category_id' => $category->id,
        //     'title' => 'UI/UX Masterclass: Crafting Intuitive Experiences',
        //     'description' => 'Pelajari riset pengguna, wireframing, hingga prototyping high-fidelity bersama para ahli industri desain.',
        //     'date' => '2026-05-12 09:00:00',
        //     'location' => 'Cinema Amikom',
        //     'price' => 75000,
        //     'stock' => 50,
        //     'poster_path' => 'posters/event-uiux.png',
        // ]);

        \App\Models\Event::create([
            'category_id' => $category4->id,
            'title' => 'E-sport U-champ: Mobile Legends Tournament',
            'description' => 'Tunjukkan kerja sama timmu dan rebut gelar juara di turnamen e-sport paling bergengsi tahun ini!',
            'date' => '2026-05-20 13:00:00',
            'location' => 'Basement Gedung 5',
            'price' => 150000,
            'stock' => 32,
            'poster_path' => 'posters/event-esport.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category2->id,
            'title' => 'Cyber Security: Defensive Programming 101',
            'description' => 'Amankan aplikasimu dari serangan SQL Injection dan XSS. Workshop praktis dengan studi kasus nyata.',
            'date' => '2026-06-01 08:30:00',
            'location' => 'Laboratorium Komputer 5',
            'price' => 25000,
            'stock' => 40,
            'poster_path' => 'posters/event-security.png',
        ]);

        // 4. Partner

        // \App\Models\Partner::create([
        //     'name' => 'Dev Web3 Jogja',
        //     'logo' => 'partner/wlmCXRbwiEsZADggYE5VDLzUQRPAqnWq5xJ7NPUe.jpg',
        // ]);

        // \App\Models\Partner::create([
        //     'name' => 'MBG (Mas Bahlil Gibran)',
        //     'logo' => 'partners/rgcPx2FqzCZHx5f8cOyXd6gFWUhnjkT6izDjNbxZ.jpg',
        // ]);

        // \App\Models\Partner::create([
        //     'name' => 'Liat Enih',
        //     'logo' => 'partners/6Q9CQPsn5r9W6DTzYCvmIlZwwPgjHx9eyqqFeoBz.jpg',
        // ]);

        // \App\Models\Partner::create([
        //     'name' => 'Oscar Piastri',
        //     'logo' => 'partners/9ImYChFLS6oHeOYBmB0fAbBis3kFGg55esvkgGFM.jpg',
        // ]);

        // \App\Models\Partner::create([
        //     'name' => 'Ad Maiora Natus Sum',
        //     'logo' => 'partners/9XxoMGngtzirKxz6cIx5GykdjNvbr61pHYJmmRvY.jpg',
        // ]);
    }
}
