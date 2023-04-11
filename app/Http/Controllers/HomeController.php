<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\UserFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if($user->hasRole('player')) {
            $favorites = UserFavorite::where('user_id', $user->id)->get();
            return view('home',['favorites'=>$favorites, 'user'=>$user]);
        } else if ($user->hasRole('host')) {
            $locations = Location::where('user_id', $user->id)->get();
            return view('home',['locations'=>$locations, 'user'=>$user]);
        }


    }
}
