<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guest = [
            [
                'name' => 'John Doe',
                'image' => 'guests/image1.jpg',
            ],
            [
                'name' => 'Jane Smith',
                'image' => 'guests/image2.jpg',
            ],

        ];

        DB::table('guests')->insert($guest);

        $concert = [
            [
                'name' => 'Reeva',
            ],
            [
                'name' => 'Chernival',
            ],

        ];

        DB::table('concerts')->insert($concert);

        $guestDetail = [
            [
                'concert_id' => '1',
                'guest_id' => '1',
            ],
            [
                'concert_id' => '1',
                'guest_id' => '2',
            ],

        ];

        DB::table('guest_details')->insert($guestDetail);

        $city = [
            [
                'name' => 'Surabaya',
            ],
            [
                'name' => 'Jakarta',
            ],

        ];

        DB::table('cities')->insert($city);

        $venue = [
            [
                'name' => 'Jatim Expo',
                'address' => 'Jl. Ahmad Yani',
                'city_id' => '1',
            ],
            [
                'name' => 'ICE BSD',
                'address' => 'BSD',
                'city_id' => '2',
            ],

        ];

        DB::table('venues')->insert($venue);

        $concertDetail = [
            [
                'date' => now()->addDays(rand(1, 30)),
                'concert_id' => '1',
                'venue_id' => '1',
            ],
            [
                'date' => now()->addDays(rand(1, 30)),
                'concert_id' => '1',
                'venue_id' => '1',
            ],

        ];

        DB::table('concert_details')->insert($concertDetail);

        $catagory = [
            [
                'seat' => '50',
                'code' => 'ST1',
                'price' => 12000.00,
                'concert_detail_id' => '1',
                'venue_id' => '1',
            ],
            [
                'seat' => '10',
                'code' => 'ST2',
                'price' => 15000.00,
                'concert_detail_id' => '1',
                'venue_id' => '1',
            ],

        ];

        DB::table('catagories')->insert($catagory);

        $payment = [
            [
                'payment' => 'Bank',
            ],
            [
                'payment' => 'QRIS',
            ],

        ];
        DB::table('payment_methods')->insert($payment);

        $transaction = [
            [
                'date' => now()->addDays(rand(1, 30)),
                'total' => 12000.45,
                'payment_method_id' => 1,
                'user_id' => 1,
            ],
            [
                'date' => now()->addDays(rand(1, 30)),
                'total' => 14000.45,
                'payment_method_id' => 1,
                'user_id' => 1,
            ],

        ];

        DB::table('transactions')->insert($transaction);
    }
}
