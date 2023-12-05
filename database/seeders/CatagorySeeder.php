<?php

namespace Database\Seeders;

use App\Models\Catagory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatagorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catagory = [
            [
                'seat' => rand(50, 100),
                'code' => 'RV1',
                'price' => 5500000.00,
                'concert_detail_id' => '1',
                'venue_id' => '1',
                'description' => 'VVIP with Backstage'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV2',
                'price' => 4000000.00,
                'concert_detail_id' => '1',
                'venue_id' => '1',
                'description' => 'Best View!'

            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV3',
                'price' => 2000000.00,
                'concert_detail_id' => '1',
                'venue_id' => '1',
                'description' => 'Comfy Seating'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV4',
                'price' => 1500000.00,
                'concert_detail_id' => '1',
                'venue_id' => '1',
                'description' => 'Best Value!'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV5',
                'price' => 1000000.00,
                'concert_detail_id' => '1',
                'venue_id' => '1',
                'description' => 'Best price!'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV1',
                'price' => 5500000.00,
                'concert_detail_id' => '2',
                'venue_id' => '1',
                'description' => 'VVIP with Backstage'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV2',
                'price' => 4000000.00,
                'concert_detail_id' => '2',
                'venue_id' => '1',
                'description' => 'Best View!'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV3',
                'price' => 2000000.00,
                'concert_detail_id' => '2',
                'venue_id' => '1',
                'description' => 'Comfy Seating'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV4',
                'price' => 1500000.00,
                'concert_detail_id' => '2',
                'venue_id' => '1',
                'description' => 'Best Value!'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV5',
                'price' => 1000000.00,
                'concert_detail_id' => '2',
                'venue_id' => '1',
                'description' => 'Best price!'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV1',
                'price' => 5500000.00,
                'concert_detail_id' => '3',
                'venue_id' => '1',
                'description' => 'VVIP with Backstage'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV2',
                'price' => 4000000.00,
                'concert_detail_id' => '3',
                'venue_id' => '1',
                'description' => 'Best View!'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV3',
                'price' => 2000000.00,
                'concert_detail_id' => '3',
                'venue_id' => '1',
                'description' => 'Comfy Seating'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV4',
                'price' => 1500000.00,
                'concert_detail_id' => '3',
                'venue_id' => '1',
                'description' => 'Best Value!'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'RV5',
                'price' => 1000000.00,
                'concert_detail_id' => '3',
                'venue_id' => '1',
                'description' => 'Best price!'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'CH1',
                'price' => 5500000.00,
                'concert_detail_id' => '4',
                'venue_id' => '2',
                'description' => 'VVIP with Backstage'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'CH2',
                'price' => 4000000.00,
                'concert_detail_id' => '4',
                'venue_id' => '2',
                'description' => 'Best View!'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'CH43',
                'price' => 2000000.00,
                'concert_detail_id' => '4',
                'venue_id' => '2',
                'description' => 'Comfy Seating'
            ],
            [
                'seat' => rand(50, 100),
                'code' => 'CH4',
                'price' => 1500000.00,
                'concert_detail_id' => '4',
                'venue_id' => '2',
                'description' => 'Best Value!'
            ],
        ];

        foreach ($catagory as $cat) {
            Catagory::create($cat);
        }
    }
}
