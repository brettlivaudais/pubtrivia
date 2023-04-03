<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;
use Database\Factories\LocationFactory;
use App\Models\City;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        Location::factory()
            ->count(1000)
            ->create();*/

        //$this->call(CitySeeder::class);
        $this->call(LocationSeeder::class);
    }
}
