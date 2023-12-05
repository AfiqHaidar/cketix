<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CitySeeder::class,
            VenueSeeder::class,
            ConcertSeeder::class,
            GuestSeeder::class,
            ConcertDetailSeeder::class,
            CatagorySeeder::class,
            PaymentSeeder::class,
            BannerSeeder::class,
        ]);
    }
}
