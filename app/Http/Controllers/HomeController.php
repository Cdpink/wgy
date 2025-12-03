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
        $user = auth()->user();

        $query = Post::with('user')->orderBy('created_at', 'desc');

        // AGE FILTER
        if ($request->filled('age')) {
            $selectedAge = $request->age;
            if ($selectedAge == 6) {
                $query->where('age', '>=', 6);
            } else {
                $query->where('age', $selectedAge);
            }
        }

        // BREED FILTER
        if ($request->filled('breed')) {
            $query->where('breed', $request->breed);
        }

        // PROVINCE FILTER
        if ($request->filled('province')) {
            $query->where('province', $request->province);
        }

        // CITY FILTER
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // AUDIENCE FILTER
        if ($request->filled('audience')) {
            if ($request->audience === 'public') {
                $query->where('audience', 'public');
            } elseif ($request->audience === 'friends') {
                $friendIds = $user->friends()->pluck('friend_id')->toArray();
                $query->where(function ($q) use ($user, $friendIds) {
                    $q->where('user_id', $user->id)
                        ->orWhere(function ($subQ) use ($friendIds) {
                            $subQ->where('audience', 'friends')
                                ->whereIn('user_id', $friendIds);
                        });
                });
            }
        }

        // Execute the query
        $posts = $query->get();
        $locations = Location::orderBy('region')->orderBy('province')->get();
        $contacts = User::where('is_online', true)
            ->where('id', '!=', $user->id)
            ->limit(10)
            ->get();

        return view('home.index', [
            'posts' => $posts,
            'locations' => $locations,
            'contacts' => $contacts,
            'user' => $user,
            'selectedCity' => $request->city ?? null,
        ]);
    }
}