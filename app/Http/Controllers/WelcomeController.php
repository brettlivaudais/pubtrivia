<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class WelcomeController extends Controller
{
    public function index()
    {
        $daysoftheweek = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        //$locations = Location::all()->take(25);

        $lat = 33.920891; // latitude of center point
        $lng = -117.261162; // longitude of center point
        $radius = 100; // search radius in miles

        $locations = DB::table('locations')
            ->selectRaw('*,
                        ( 3959 * acos( cos( radians(?) ) *
                        cos( radians( `lat` ) )
                        * cos( radians( `long` ) - radians(?)
                        ) + sin( radians(?) ) *
                        sin( radians( `lat` ) ) )
                        ) AS distance', [$lat, $lng, $lat])
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->take(100)
            ->get();


        return view('welcome', compact('locations','daysoftheweek'));
    }
}
