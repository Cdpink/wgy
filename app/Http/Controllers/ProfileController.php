<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\DogPhoto; 

class ProfileController extends Controller
{
    public function index()
{
    $user = auth()->user();

    $posts = Post::where('user_id', $user->id)->get();

    //  GET ALL DOG PHOTOS
    $dogPhotos = DogPhoto::where('user_id', $user->id)->get();

    return view('profiles.profile', compact('user', 'posts', 'dogPhotos'));
}

}
