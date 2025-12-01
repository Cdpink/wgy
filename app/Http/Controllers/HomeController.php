<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('user')->orderBy('created_at', 'desc');

        // AGE FILTER
        if ($request->has('age') && $request->age != '') {
            $selectedAge = $request->age;
            if ($selectedAge == 6) {
                $query->where('age', '>=', 6);
            } else {
                $query->where('age', $selectedAge);
            }
        }

        // BREED FILTER
        if ($request->has('breed') && $request->breed != '') {
            $query->where('breed', $request->breed);
        }

        // PROVINCE FILTER

        // AUDIENCE FILTER
        $selectedType = $request->type ?? 'all';
        if ($selectedType !== 'all') {
            $query->where('audience', $selectedType);
        }
        $posts = $query->get();
        $locations = Location::orderBy('region')->orderBy('province')->get();
        $contacts = User::where('is_online', true)->limit(10)->get();
        $user = Auth::user();
        $selectedCity = $request->city ?? null;


        return view('home.index', compact('posts', 'locations', 'contacts', 'user', 'selectedCity'));
    }
}