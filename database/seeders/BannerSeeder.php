<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $banners = [
            [
                'header' => $faker->sentence,
                'subheader' => $faker->sentence,
                'image' => 'banners/h1.jpg'
            ],
            [
                'header' => $faker->sentence,
                'subheader' => $faker->sentence,
                'image' => 'banners/h2.jpg'
            ],
            [
                'header' => $faker->sentence,
                'subheader' => $faker->sentence,
                'image' => 'banners/h3.jpg'
            ]
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
