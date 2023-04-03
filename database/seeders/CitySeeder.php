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


       /*
       $json = File::get("database/seeders/data/city.json");
       $cities = json_decode($json);

       foreach ($cities as $key=>$value) {
        if($value->latitude && $value->longitude) {
            City::create([
              "zip_code" => str_pad($value->zip_code, 5, '0', STR_PAD_LEFT),
              "latitude" => $value->latitude,
              "longitude" => $value->longitude,
              "city" => $value->city,
              "state" => $value->state,
              "county" => $value->county
            ]);
          }
       }
       */
    }
}
