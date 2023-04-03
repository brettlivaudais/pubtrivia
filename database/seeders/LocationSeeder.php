<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Facades\Hash;

use File;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
    /*
        Location::truncate();
        User::truncate();

        //Geeks Who Drink
        $user = new User([
            'name' => 'Geeks Who Drink',
            'email' => 'sample@example.com',
            'password' => Hash::make('test123'),
            'account_type' => 'host'
        ]);
        $user->save();
        $user_id = $user->id;

        $json = File::get("database/seeders/data/loc_geekswhodrink.json");
        $locations = json_decode($json);
        foreach ($locations as $key=>$value) {

            $address_parts = explode(',',$value->address);
            

            $delimiter = ',';
            $zip = substr(trim($value->address), -5);
            $state = substr(substr(trim($value->address), -8), 0, 2);
            $city = trim($address_parts[count($address_parts) - 2]);

            Location::create([
              'user_id' => $user_id,
              'name' => html_entity_decode($value->name),
              'address' => $value->address,
              
              'city'=> $city,
              'state'=> $state,
              'zip'=> $zip,
              'lat'=> $value->lat,
              'long'=> $value->long,
              'dayoftheweek'=> $value->day,
              'time'=> '7:00',//$value->time,
              'logo_url'=> $value->logo_url,
              'published'=> 1,
            ]);
       }
    */


    //Pour House CA 
       $user = new User([
        'name' => 'Pour House California',
        'email' => 'sample2@example.com',
        'password' => Hash::make('test123'),
        'account_type' => 'host'
    ]);
    $user->save();
    $user_id = $user->id;

    $json = File::get("database/seeders/data/loc_pourhouse.json");
    $locations = json_decode($json);
    foreach ($locations as $key=>$value) {
        $address_parts = explode(',',$value->address);
        $delimiter = ',';
        $zip = substr(trim($value->address), -5);
        $state = substr(substr(trim($value->address), -8), 0, 2);
        $city = trim($address_parts[count($address_parts) - 2]);

        Location::create([
          'user_id' => $user_id,
          'name' => html_entity_decode($value->name),
          'address' => $value->address,
          /*'street'=> $street,*/
          'city'=> $city,
          'state'=> $state,
          'zip'=> $zip,
          'lat'=> $value->lat,
          'long'=> $value->long,
          'dayoftheweek'=> $value->day,
          'time'=> '7:00',//$value->time,
          'logo_url'=> $value->logo_url,
          'published'=> 1,
        ]);
   }


    }
}
