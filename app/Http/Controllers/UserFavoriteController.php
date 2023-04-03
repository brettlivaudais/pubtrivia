<?php

namespace App\Http\Controllers;

use App\Models\UserFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFavoriteController extends Controller
{
    /**
     * Add a favorite location for the logged in user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add($location_id)
    {
        $user = Auth::user();
 
        if (!$location_id) {
            return response()->json([
                'error' => 'Missing location_id query parameter.',
            ], 400);
        }

        $userFavorite = new UserFavorite([
            'user_id' => $user->id,
            'location_id' => $location_id,
        ]);

        $userFavorite->save();

        return response()->json([
            'message' => 'Favorite location added successfully.',
            'user_favorite' => $userFavorite,
        ]);
    }

    /**
     * Remove a favorite location for the logged in user.
     *
     * @param  int  $location_id
     * @return \Illuminate\Http\Response
     */
    public function remove($location_id)
    {
        $user = Auth::user();

        $userFavorite = UserFavorite::where([
            'user_id' => $user->id,
            'location_id' => $location_id,
        ])->first();

        
        if (!$userFavorite) {
            /*
            return response()->json([
                'error' => 'Favorite location not found for user.',
            ], 404);
            */
            return response()->json([
                'message' => 'Favorite location not found, but that\s ok.',
            ]);
        }

        $userFavorite->delete();

        return response()->json([
            'message' => 'Favorite location removed successfully.',
        ]);
    }
}
