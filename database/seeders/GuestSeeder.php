<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\GuestDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guest = [
            [
                'name' => 'Barsena Bestandhi',
                'image' => 'guests/barsena.jpg',
                'pquote' => 'Berlari tanpa henti'
            ],
            [
                'name' => 'Ghea Indrawari',
                'image' => 'guests/ghea.jpg',
                'pquote' => 'Bawa lukamu biar aku obati'
            ],
            [
                'name' => 'Rea Indranata',
                'image' => 'guests/rea.jpg',
                'pquote' => 'Tidakkah letih kakimu berlari'
            ],
            [
                'name' => 'Kai Tsang',
                'image' => 'guests/kai.jpg',
                'pquote' => 'Ada hal yang mereka tak mengerti'
            ],
            [
                'name' => 'Kelly Clarkson',
                'image' => 'guests/kelly.jpg',
                'pquote' => 'Beri waktu tuk bersandar sebentar'
            ],
            [
                'name' => 'Freya JKT48',
                'image' => 'guests/freya.jpg',
                'pquote' => 'Selama ini kau hebat'
            ],
            [
                'name' => 'Adam Levine',
                'image' => 'guests/barsena.jpg',
                'pquote' => 'Menangislah, kan kita manusia'
            ],
            [
                'name' => 'Bianda Nur',
                'image' => 'guests/bianda.jpg',
                'pquote' => 'Berpura-pura sempura'
            ],
        ];

        foreach ($guest as $g) {
            Guest::create($g);
        }
    }
}
