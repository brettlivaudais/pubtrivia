<?php

namespace App\Http\Controllers;

use App\Models\UserLocationRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserLocationRatingController extends Controller
{
    public function addOrUpdateRating($location_id, $rating)
    {
        $user_id = Auth::user()->id;

        $userLocationRating = UserLocationRating::where('user_id', $user_id)
            ->where('location_id', $location_id)
            ->first();

        if (!$userLocationRating) {
            $userLocationRating = new UserLocationRating();
            $userLocationRating->user_id = $user_id;
            $userLocationRating->location_id = $location_id;
        }

        $userLocationRating->rating = $rating;
        $userLocationRating->save();

        return response()->json(['success' => true, 'rating' => $userLocationRating]);
    }
}
