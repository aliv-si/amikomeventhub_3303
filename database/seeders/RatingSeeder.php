<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Support\Str;

class RatingSeeder extends Seeder
{
    /**
     * Membuat data dummy rating untuk setiap event.
     */
    public function run(): void
    {
        $events = Event::all();
        $names = ['Budi Santoso', 'Siti Rahayu', 'Andi Prasetyo', 'Dewi Lestari', 'Rizky Firmansyah', 'Putri Amelia', 'Agus Supriyadi', 'Dian Kusuma', 'Hendra Wijaya', 'Lia Marlina'];
        $domains = ['gmail.com', 'yahoo.com', 'outlook.com'];

        $reviews = [
            'Eventnya seru banget! Bakal ikut lagi tahun depan.',
            'Acaranya lumayan bagus, tapi sound systemnya kurang jelas.',
            'Pematerinya sangat menginspirasi. Terima kasih!',
            'Biasa aja sih, tapi not bad lah buat ngisi waktu luang.',
            'Wah gila keren parah! Worth it banget harganya.',
            'Acaranya terorganisir dengan sangat baik, rapi.',
            'Sangat bermanfaat materinya. Recommended!',
            'Keren! Ditunggu event selanjutnya.',
            'Lumayan seru, cuma venuenya agak panas.'
        ];

        foreach ($events as $event) {
            // Buat 3-8 transaksi dummy dengan rating untuk setiap event
            $count = rand(3, 8);

            for ($i = 0; $i < $count; $i++) {
                $name = $names[array_rand($names)];
                $email = strtolower(str_replace(' ', '.', $name)) . rand(1, 99) . '@' . $domains[array_rand($domains)];
                
                $rating = rand(3, 5);
                $reviewText = ($rating >= 4) ? $reviews[array_rand($reviews)] : null; // Kasih review kalau rating bagus (contoh)

                Transaction::create([
                    'event_id' => $event->id,
                    'order_id' => 'DUMMY-' . strtoupper(Str::random(8)),
                    'customer_name' => $name,
                    'customer_email' => $email,
                    'customer_phone' => '08' . rand(1000000000, 9999999999),
                    'total_price' => $event->price + 5000,
                    'status' => 'success',
                    'rating' => $rating,
                    'review' => $reviewText,
                ]);
            }
        }
    }
}
