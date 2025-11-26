<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostLike;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
{
    // 1. VALIDATION
    $request->validate([
        'content' => 'nullable|string|max:1000',
        'age' => 'nullable|string',
        'breed' => 'nullable|string',
        'province' => 'nullable|string',
        'city' => 'nullable|string',
        'interest' => 'nullable|string',
        'audience' => 'nullable|string',
        'photoUpload' => 'nullable|image|max:4096',
    ]);

    $photoPath = null;

    // 2. If user uploaded REAL file from form
    if ($request->hasFile('photoUpload')) {
        $photoPath = $request->file('photoUpload')->store('posts', 'public');
    }

    // 3. If NO FILE uploaded but there is SESSION BASE64
    if (!$photoPath && $request->image_base64) {

        $data = $request->image_base64;

        // remove base64 prefixes
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace('data:image/jpeg;base64,', '', $data);

        $data = base64_decode($data);

        // save manually
        $fileName = 'post_' . time() . '.jpg';
        $path = storage_path('app/public/posts/' . $fileName);

        file_put_contents($path, $data);

        $photoPath = 'posts/' . $fileName;
    }

    // 4. CREATE POST
    Post::create([
        'user_id' => auth()->id(),
        'message' => $request->content,
        'age' => $request->age,
        'breed' => $request->breed,
        'province' => $request->province,
        'city' => $request->city,
        'interest' => $request->interest,
        'audience' => $request->audience,
        'photo' => $photoPath,
    ]);

    // CLEAR SESSION IMAGE
    session()->forget('uploaded_image');

    return redirect()->route('home')->with('success', 'Post created successfully!');
}



    public function like($id)
    {
        $post = Post::findOrFail($id);
        
        $existingLike = PostLike::where('post_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            $post->decrement('likes_count');
        } else {
            PostLike::create([
                'post_id' => $id,
                'user_id' => auth()->id(),
            ]);
            $post->increment('likes_count');
        }

        return back();
    }

    public function create(Request $request)
    {
        $image = $request->image ?? null; // Base64 image from upload page
        return view('posts.index', compact('image'));
    }
    public function setUploadSession(Request $request)
{
    if ($request->hasFile('image')) {
        $image = base64_encode(file_get_contents($request->file('image')));
        session(['uploaded_image' => 'data:image/png;base64,' . $image]);

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}
public function postingPage()
{
     
    return view('posts.index'); // ← change to your actual Blade filename
}

public function destroy($id)
{
    $post = Post::findOrFail($id);

    if ($post->user_id !== auth()->id()) {
        return back()->with('error', 'You are not allowed to delete this post.');
    }

    if ($post->photo && file_exists(storage_path('app/public/'.$post->photo))) {
        unlink(storage_path('app/public/'.$post->photo));
    }

    $post->delete();

    return back()->with('success', 'Post deleted successfully.');
}

public function report($id)
{
    // You may save this to a reports table later
    return back()->with('success', 'Post has been reported.');
}

public function block($user_id)
{
    // optional: create a "blocked_users" table
    return back()->with('success', 'User has been blocked.');
}


}
