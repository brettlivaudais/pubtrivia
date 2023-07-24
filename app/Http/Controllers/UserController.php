<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFavorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'You are not logged in.');
        }

        return view('users.edit', compact('user'));
    }

    public function show($slug)
    {
        $user = User::where('slug',$slug)->first();


        return view('users.show', [
            'user' => $user,
            'locations' => UserFavorite::where('user_id', $user->id)->get()
        ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if (!$user) {
            return redirect()->back()->with('error', 'You are not authorized to edit this user.');
        }

        /*
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        
        */

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'hometown' => ['nullable', 'string', 'max:255'],
            'introduction' => ['nullable', 'string'],
            'photo_url' => ['nullable', 'url', 'max:255'],
            'birthday' => ['nullable', 'date', 'before_or_equal:today'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'snapchat' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'tiktok' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
            'github' => ['nullable', 'string', 'max:255'],
            'discord' => ['nullable', 'string', 'max:255'],
            'youtube' => ['nullable', 'string', 'max:255'],
            'team_name' => ['nullable', 'string', 'max:255'],
        ]);

        if($request->new_password != '') {
            $validatedPasswordData = $request->validate([
                'new_password' => 'required|string|min:8|confirmed'
            ]);
            $validatedData['password'] = Hash::make($request->new_password);
        }


        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed file types and size as per your requirements
            ]);

            $image = $request->file('image');
            $imageName = $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile_photos'), $imageName);

            $validatedData['photo_url'] = "/profile_photos/" . $imageName;
        }




        $validatedData['show_favorites'] = $request->has('show_favorites');

        $user->update($validatedData);

        return redirect()->back()->with('success', 'Your profile was saved.');
    }
}
