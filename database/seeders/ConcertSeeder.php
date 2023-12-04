<?php

namespace Database\Seeders;

use App\Models\Concert;
use App\Models\ConcertDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ConcertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $concerts = [
            [
                'name' => 'Reeva',
                'image' => 'concerts/reeva.jpg',
                'short_desc' => $faker->sentence,
                'long_desc' => $faker->paragraph,
            ],
            [
                'name' => 'Chernival',
                'image' => 'concerts/chernival.jpg',
                'short_desc' => $faker->sentence,
                'long_desc' => $faker->paragraph,
            ],
            [
                'name' => 'Waku Waku',
                'image' => 'concerts/waku.jpg',
                'short_desc' => $faker->sentence,
                'long_desc' => $faker->paragraph,
            ],
            [
                'name' => 'Cold Nights',
                'image' => 'concerts/cold.jpg',
                'short_desc' => $faker->sentence,
                'long_desc' => $faker->paragraph,
            ],
            [
                'name' => 'Midnight Waves',
                'image' => 'concerts/midnight.jpg',
                'short_desc' => $faker->sentence,
                'long_desc' => $faker->paragraph,
            ],
        ];

        foreach ($concerts as $concert) {
            Concert::create($concert);
        }

        $concertDetails = [
            [
                'date' => now()->addDays(2),
                'concert_id' => '1',
                'venue_id' => '1',
                'map' => 'maps/m1.jpg'
            ],
            [
                'date' => now()->addDays(3),
                'concert_id' => '1',
                'venue_id' => '1',
                'map' => 'maps/m1.jpg'
            ],
            [
                'date' => now()->addDays(4),
                'concert_id' => '1',
                'venue_id' => '1',
                'map' => 'maps/m1.jpg'
            ],
            [
                'date' => now()->addDays(6),
                'concert_id' => '2',
                'venue_id' => '2',
                'map' => 'maps/m2.jpg'
            ],
            [
                'date' => now()->addDays(7),
                'concert_id' => '2',
                'venue_id' => '2',
                'map' => 'maps/m2.jpg'
            ],
            [
                'date' => now()->addDays(10),
                'concert_id' => '3',
                'venue_id' => '3',
                'map' => 'maps/m3.jpg'
            ],
            [
                'date' => now()->addDays(11),
                'concert_id' => '3',
                'venue_id' => '3',
                'map' => 'maps/m3.jpg'
            ],
            [
                'date' => now()->addDays(12),
                'concert_id' => '3',
                'venue_id' => '3',
                'map' => 'maps/m3.jpg'
            ],
            [
                'date' => now()->addDays(15),
                'concert_id' => '4',
                'venue_id' => '4',
                'map' => 'maps/m4.png'
            ],
            [
                'date' => now()->addDays(16),
                'concert_id' => '4',
                'venue_id' => '4',
                'map' => 'maps/m4.png'
            ],
            [
                'date' => now()->addDays(17),
                'concert_id' => '5',
                'venue_id' => '5',
                'map' => 'maps/m5.jpg'
            ],
            [
                'date' => now()->addDays(18),
                'concert_id' => '5',
                'venue_id' => '5',
                'map' => 'maps/m5.jpg'
            ],
            [
                'date' => now()->addDays(19),
                'concert_id' => '5',
                'venue_id' => '5',
                'map' => 'maps/m5.jpg'
            ],

        ];

        foreach ($concertDetails as $concertDetail) {
            ConcertDetail::create($concertDetail);
        }
    }
}
