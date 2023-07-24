<?php

namespace App\Http\Controllers;

use App\Helpers\PositionStackHelper;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\City;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserLocationRating;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class LocationController extends Controller
{
    public function index()
    {
        $states = config('states');
        $citystate = [];
        $locations = Location::select('city','state', DB::raw('COUNT(DISTINCT id) as city_count'))->groupBy('city','state')->get();
        foreach($locations as $result) {
            $citystate[$states[$result->state]][$result->city] = $result->city_count;
        }
        ksort($citystate);
        return view('locations.index', ['citystate'=>$citystate, 'state_lookup' => array_flip($states)]);
    }

    public function city($state,$city)
    {
        $locations = Location::where('city', $city)
                    ->where('state', $state)
                    ->get();
        return view('locations.city', ['locations'=>$locations, 'city'=>$city, 'state' => $state]);
    }

    public function host($slug)
    {
        $host = User::where('slug',$slug)->first();
        $locations = Location::where('user_id', $host->id)->get();
        return view('users.host', ['locations'=>$locations, 'user'=>$host]);
    }


    public function create()
    {
        return view('locations.edit');
    }

    public function store(Request $request)
    {
        $position = PositionStackHelper::getLatLongbyAddress($request->input('address') . ", " . $request->input('city') . ', ' . $request->input('state'));
       
        $location = new Location;
        $location->user_id = $request->input('user_id');
        $location->name = $request->input('name');
        $location->description = $request->input('description');
        $location->address = $request->input('address');
        $location->city = $request->input('city');
        $location->state = $request->input('state');
        $location->zip = $request->input('zip');
        $location->slug = $this->makeSlug($request->input('name'),'locations');
        $location->lat = $position['latitude'];
        $location->long = $position['longitude'];
        $location->dayoftheweek = $request->input('dayoftheweek');
        $location->time = $request->input('time');
        
        if($request->file('logo_upload')) {
            $path = $request->file('logo_upload')->store('public/images');
            $location->logo_url = Storage::url($path);
        }
        
        $location->published = $request->has('published');
        
        $user = Auth::user();
        $location->user_id = $user->id;

        $location->save();

        return redirect()->route('home')->with('success', 'Location created successfully!');
    }

    public function show($slug)
    {
        $location = Location::with('user')->with('comments.user')->where('slug',$slug)->first();
        $user = Auth::user();
        $rating = 0;
        $is_favorite = false;
        if($user) {
            if(Auth::user()->favorites->where('location_id','=',$location->id)->count()) {
                $is_favorite = true;
            }
            $rating = UserLocationRating::where('location_id','=',$location->id)->where('user_id','=',$user->id)->first()->rating ?? 0;
        }
     
        if($location->ratings) {
            $avgRating = $location->averageRating();
        }

        if(strpos(url()->current(),'preview')!==false) {
            $view = 'locations.preview';
        } else {
            $view = 'locations.show';
        }

        return view($view, ['location' => $location, 'is_favorite' => $is_favorite, 'rating' => $rating, 'avgRating' => $avgRating]);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $location = Location::where('id',$id)->where('user_id',$user->id)->first();
        if($location) {
            return view('locations.edit', compact('location'));
        } else {
            return redirect()->route('home')->with('error', 'You do not have access to this location.');
        }
    }

    public function update(Request $request, $id)
    {

        $user = Auth::user();
        $location = Location::where('id',$id)->where('user_id',$user->id)->first();
        if($location) {

            $old_address = $location->address . ", " . $location->city . ', ' . $location->state;
            $new_address = $request->input('address') . ", " . $request->input('city') . ', ' . $request->input('state');
            if($old_address != $new_address)
            {
                $position = PositionStackHelper::getLatLongbyAddress($request->input('address') . ", " . $request->input('city') . ', ' . $request->input('state'));
                $location->lat = $position['latitude'];
                $location->long = $position['longitude'];
                $location->address = $request->input('address');
                $location->city = $request->input('city');
                $location->state = $request->input('state');
                $location->zip = $request->input('zip');
            }
       
            $location->name = $request->input('name');
            $location->description = $request->input('description');
            $location->dayoftheweek = $request->input('dayoftheweek');
            $location->time = $request->input('time');
            $location->published = $request->has('published');

            if($request->file('logo_upload')) {
                $path = $request->file('logo_upload')->store('public/images');
                $location->logo_url = Storage::url($path);
            }

            $location->save();

            return redirect()->route('home')->with('success', $location->name . ' has been saved!');
        } else {
            return redirect()->route('home')->with('error', 'You do not have access to this location.');
        }
    }

    public function destroy($id)
    {
        /*
        $location = Location::find($id);
        $location->delete();

        return redirect()->route('locations.index')->with('success', 'Location deleted successfully!');
        */
    }

    public function apiSearch(Request $request) {
        $error = '';
        $lat = $request->cookie('lat');
        $lng = $request->cookie('long');
        $radius = $request->input('distance')?$request->input('distance'):15;
        $coordinates = $request->input('coordinates');

        if($coordinates) {

            list($south,$west,$north,$east) = explode("|",$coordinates);

            $lat = ($south+$north) / 2;
            $lng = ($west+$east) / 2;

            $locations = DB::table('locations')
            ->selectRaw('*,
                        ROUND(( 3959 * acos( cos( radians(?) ) *
                        cos( radians( `lat` ) )
                        * cos( radians( `long` ) - radians(?)
                        ) + sin( radians(?) ) *
                        sin( radians( `lat` ) ) )
                        ),0) AS distance', [$lat, $lng, $lat])
            ->whereBetween('lat',[$south,$north])
            ->whereBetween('long',[$east,$west])
            ->where('published',1)
            //->having('distance', '<', $radius)
            ->orderBy('distance')
            ->take(50)
            ->get();
            $response['lat'] = $lat;
            $response['lng'] = $lng;
            $response['locations'] = $locations;
            return response()->json($response);




        } else {
            if(!($lat && $lng)) {
                $search = trim($request->input('search'));
                $city = City::select('latitude','longitude')
                            ->where('zip_code','LIKE', $search)
                            ->orWhere('city', 'LIKE', $search)
                            ->orWhere('state', 'LIKE', $search)
                            ->orWhere(DB::raw("CONCAT(`city`, ', ', `state`)"), 'LIKE', $search)
                            ->orWhere(DB::raw("CONCAT(`city`, ',', `state`)"), 'LIKE', $search)
                            ->orWhere(DB::raw("CONCAT(`city`, ' ', `state`)"), 'LIKE', $search)
                            ->first();
                if($city) {
                    $lat = $city->latitude;
                    $lng = $city->longitude;
                } else {
                    $error = "'error':'City'";
                }
            }
        
            if($lat && $lng) {
                $locations = DB::table('locations')
                ->selectRaw('*,
                            ROUND(( 3959 * acos( cos( radians(?) ) *
                            cos( radians( `lat` ) )
                            * cos( radians( `long` ) - radians(?)
                            ) + sin( radians(?) ) *
                            sin( radians( `lat` ) ) )
                            ),0) AS distance', [$lat, $lng, $lat])
                ->having('distance', '<', $radius)
                ->orderBy('distance')
                ->take(50)
                ->get();
                $response['lat'] = $lat;
                $response['lng'] = $lng;
                $response['locations'] = $locations;
                return response()->json($response);
            } else {
                return response()->json($error);
            }
        }
    }

    public function fixer()
    {
        echo "<pre>";
        /*
        //find any location without a slug, give it one
        $locations = Location::where('slug', null)->get();
        foreach($locations as $location) {
            $update_location = Location::find($location->id);
            $update_location->slug = $this->makeSlug($location->name,'locations'); 
            echo $location->name . ': ' . $update_location->slug . '<br>';
            $update_location->save(); 
        }

        //find any location without latitude and longitude
        $locations = Location::where('lat', null)->get();
        foreach($locations as $location) {
            $position = PositionStackHelper::getLatLongbyAddress($location->address . ", " . $location->city . ', ' . $location->state . ' ' . $location->zip);
       
            $update_location = Location::find($location->id);
            $update_location->lat = $position['latitude'];
            $update_location->long = $position['longitude'];
            echo $location->name . ': ' . $position['latitude'] . ',' . $position['longitude'] . '<br>';
            $update_location->save();
        }

        //find any location without a city, state, or zip
        $locations = Location::where('zip', null)->orWhere('city',null)->orWhere('state',null)->get();
        foreach($locations as $location) {
            $position = PositionStackHelper::getLocationByLatLong($location->lat,$location->long);
            $update_location = Location::find($location->id);
            
            echo $location->name . " (".$location->lat . ',' . $location->long .") <br>";
            
            if(!$location->city) {
                $update_location->city = $position['locality'];
            }

            if(!$location->state) {
                $update_location->state = $position['region_code'];
            }

            if(!$location->zip && $position['postal_code']) {
                $update_location->zip = $position['postal_code'];
            }
            
            $update_location->street = serialize($position);
            
            $update_location->save();
            
        }
        */

        //fix geeks who drink
        //$locations = Location::where('user_id', 1)->offset(1)->limit(2)->get();
        $locations = Location::where('city', 'LIKE', '%[0-9]%')->limit(1)->get();
        foreach($locations as $location) {
            $position = PositionStackHelper::getLatLongbyAddress($location->address);
            $update_location = Location::find($location->id);

            print_r($position);
            echo "<hr>";

            if(array_key_exists('locality',$position)) $update_location->city = $position['locality'];
            if(array_key_exists('region_code',$position)) $update_location->state = $position['region_code'];
            if(array_key_exists('postal_code',$position)) $update_location->zip = $position['postal_code'];
           
            $update_location->street = serialize($position);
            $update_location->description = '1';
            
            $update_location->save();
            
        }

        
        die();
    }

    public function makeSlug($title, $table)
    {
        $slug = Str::slug($title);
        $count = 0;

        while (DB::table($table)->where('slug', $slug)->exists()) {
            $count++;
            $slug = Str::slug($title) . '-' . $count;
        }

        return $slug;
    }
}
