<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FriendRequest;

class FriendRequestController extends Controller
{
    public function index()
    {
        $friendRequests = FriendRequest::with(['sender.dog'])
            ->where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        return view('friend-requests.index', compact('friendRequests'));
    }

    public function send(Request $request)
    {
        FriendRequest::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Friend request sent!');
    }

    public function accept($id)
    {
        $request = FriendRequest::where('id', $id)
            ->where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();
            
        $request->update(['status' => 'accepted']);

        return back()->with('success', 'Friend request accepted!');
    }

    public function reject($id)
    {
        $request = FriendRequest::where('id', $id)
            ->where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();
            
        $request->update(['status' => 'rejected']);

        return back()->with('success', 'Friend request rejected!');
    }
}
