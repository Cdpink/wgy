<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;       // ✅ Correct import
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Start building the query
        $query = Post::with('user')->orderBy('created_at', 'desc');

        // =============================
        // AGE FILTER
        // =============================
        if ($request->has('age') && $request->age != '') {
            $selectedAge = $request->age;

            if ($selectedAge == 6) {
                // 6+ years old means >= 6
                $query->where('age', '>=', 6);
            } else {
                $query->where('age', $selectedAge);
            }
        }

        // BREED FILTER
        if ($request->has('breed') && $request->breed != '') {
            $query->where('breed', $request->breed);
        }

        // LOCATION FILTER
        if ($request->has('location') && $request->location != '') {
            $query->where(function ($q) use ($request) {
                $q->where('city', $request->location)
                  ->orWhere('province', $request->location);
            });
        }

        // AUDIENCE FILTER
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('audience', $request->type);
        }

        // FINAL FETCH
        $posts = $query->get();

        $locations = Location::all();
        $contacts = User::where('is_online', true)->limit(10)->get();
        $user = Auth::user();

        return view('home.index', compact('posts', 'locations', 'contacts', 'user'));
    }
}
