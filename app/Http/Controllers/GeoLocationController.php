<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use App\Helpers\PositionStackHelper;

class GeoLocationController extends Controller
{
    public function getLocationByLatLong($lat,$long) 
    {
        $body = PositionStackHelper::getLocationByLatLong($lat,$long);
        return $body;
    }

    public function autocompleteSearch($search)
    {
        $cities = City::select('city','state')->where('zip_code','LIKE', $search .'%')
        ->orWhere('city', 'LIKE', '%'.$search.'%')
        ->orWhere('state', 'LIKE', '%'.$search.'%')
        ->orWhere(DB::raw("CONCAT(`city`, ', ', `state`)"), 'LIKE', '%'.$search.'%')
        ->orWhere(DB::raw("CONCAT(`city`, ',', `state`)"), 'LIKE', '%'.$search.'%')
        ->orWhere(DB::raw("CONCAT(`city`, ' ', `state`)"), 'LIKE', '%'.$search.'%')
        ->orWhere('state', 'LIKE', '%'.$search.'%')
        //->groupBy('city','state')
		->distinct()
        ->take(15)
        ->get();
        //->toSql();


        return response()->json($cities);
    }
}
