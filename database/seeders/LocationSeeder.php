<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Location;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Helpers\PositionStackHelper;


use File;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
    
      /*
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Comment::truncate();
        Location::truncate();
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //Geeks Who Drink
        $user = new User([
            'name' => 'Geeks Who Drink',
            'email' => 'sample@example.com',
            'password' => Hash::make('test123'),
            'slug' => Str::slug('Geeks Who Drink')
        ]);
        $user->save();
        $user->roles()->attach(2);
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
              
              
              
              'lat'=> $value->lat,
              'long'=> $value->long,
              'dayoftheweek'=> $value->day,
              'time'=> '7:00',//$value->time,
              'logo_url'=> $value->logo_url,
              'published'=> 1,
            ]);
       }
    


    //Pour House CA 
       $user = new User([
        'name' => 'Pour House California',
        'email' => 'sample2@example.com',
        'password' => Hash::make('test123'),
        'slug' => Str::slug('Pour House California')
    ]);
    $user->save();
    $user->roles()->attach(2);
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


  //America's Pub Quiz
  $user = new User([
    'name' => "America's Pub Quiz",
    'email' => 'sample3@example.com',
    'password' => Hash::make('test123'),
    'slug' => Str::slug("America's Pub Quiz")
  ]);
  $user->save();
  $user->roles()->attach(2);
  $user_id = $user->id;

  $json = File::get("database/seeders/data/loc_americaspubquiz.json");
  $locations = json_decode($json);
  foreach ($locations as $key=>$value) {
    
       
    Location::create([
      'user_id' => $user_id,
      'name' => html_entity_decode($value->name),
      'address' => $value->address,
      'city'=> $value->city,
      'state'=> $value->state,
      'zip'=> $value->zip,
      'dayoftheweek'=> $value->day,
      'time'=> $value->time,
      'logo_url'=> $value->logo_url,
      'published'=> 1,
    ]);
  }


  //Pub Trivia USA
  $user = new User([
    'name' => "Pub Trivia USA",
    'email' => 'sample4@example.com',
    'password' => Hash::make('test123'),
    'slug' => Str::slug("Pub Trivia USA")
  ]);
  $user->save();
  $user->roles()->attach(2);
  $user_id = $user->id;

  $json = File::get("database/seeders/data/loc_pubtriviausa.json");
  $locations = json_decode($json);
  foreach ($locations as $key=>$value) {
    
    
       
    Location::create([
      'user_id' => $user_id,
      'name' => html_entity_decode($value->name),
      'address' => $value->address,
      'city'=> $value->city,
      'state'=> $value->state,
      'zip'=> $value->zip,
      'dayoftheweek'=> $value->day,
      'time'=> $value->time,
      'logo_url'=> $value->logo_url,
      'published'=> 1,
    ]);
  }
*/

    }
}
