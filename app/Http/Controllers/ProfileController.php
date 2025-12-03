<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\DogPhoto;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $posts = Post::where('user_id', $user->id)->get();

        //  GET ALL DOG PHOTOS
        $dogPhotos = DogPhoto::where('user_id', $user->id)->get();

        $isOwnProfile = true;

        return view('profiles.profile', compact('user', 'posts', 'dogPhotos', 'isOwnProfile'));
    }

    public function show($userId)
    {
        $user = User::findOrFail($userId);

        // If viewing own profile, redirect to /profile
        if ($user->id === auth()->id()) {
            return redirect()->route('profile');
        }

        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $dogPhotos = DogPhoto::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $isOwnProfile = false;

        return view('profiles.profile', compact('user', 'posts', 'dogPhotos', 'isOwnProfile'));
    }
}