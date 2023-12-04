<?php

namespace Database\Seeders;

use App\Models\GuestDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConcertDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guestDetail = [
            [
                'concert_id' => '1',
                'guest_id' => '1',
            ],
            [
                'concert_id' => '1',
                'guest_id' => '2',
            ],
            [
                'concert_id' => '2',
                'guest_id' => '3',
            ],
            [
                'concert_id' => '3',
                'guest_id' => '4',
            ],
            [
                'concert_id' => '3',
                'guest_id' => '5',
            ],
            [
                'concert_id' => '4',
                'guest_id' => '6',
            ],
            [
                'concert_id' => '5',
                'guest_id' => '7',
            ],
            [
                'concert_id' => '5',
                'guest_id' => '8',
            ],

        ];

        foreach ($guestDetail as $gd) {
            GuestDetail::create($gd);
        }
    }
}
