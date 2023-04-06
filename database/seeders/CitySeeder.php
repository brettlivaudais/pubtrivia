<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use File;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       City::truncate();
       $file = file("database/seeders/data/US.txt");
      

       foreach($file as $line) {
          list($country,$zip,$city,$state,$st,$county,$something1,$something2,$something3,$latitude,$longitude,$something5) = explode("	",$line);
          City::create([
            "zip_code" => $zip,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "city" => $city,
            "state" => $st,
            "county" => $county
          ]);
        }
    }
}
