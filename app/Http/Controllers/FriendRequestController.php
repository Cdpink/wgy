<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FriendRequestController extends Controller
{
    public function index()
    {
        $friendRequests = FriendRequest::where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->with('sender')
            ->get();

        return view('friend-requests.index', compact('friendRequests'));
    }

    // SEND FRIEND REQUEST
    public function send(Request $request)
    {
        $receiverId = $request->receiver_id;
        $senderId = auth()->id();

        // Validation
        if ($senderId == $receiverId) {
            return back()->with('error', 'You cannot send a friend request to yourself.');
        }

        // Check if already friends
        if (auth()->user()->isFriendsWith($receiverId)) {
            return back()->with('error', 'You are already friends with this user.');
        }

        // Check if YOU already sent 
        $existingRequestFromMe = FriendRequest::where('sender_id', $senderId)
            ->where('receiver_id', $receiverId)
            ->where('status', 'pending')
            ->first();

        if ($existingRequestFromMe) {
            return back()->with('error', 'You already sent a friend request to this user.');
        }

        $existingRequestToMe = FriendRequest::where('sender_id', $receiverId)
            ->where('receiver_id', $senderId)
            ->where('status', 'pending')
            ->first();

        if ($existingRequestToMe) {
            return back()->with('error', 'This user already sent you a friend request. Please check your friend requests page.');
        }

        FriendRequest::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Friend request sent!');
    }

    // CANCEL FRIEND REQUEST 
    public function cancel($id)
    {
        $request = FriendRequest::findOrFail($id);

        if ($request->sender_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        if ($request->status !== 'pending') {
            return back()->with('error', 'This request cannot be cancelled.');
        }

        $request->delete();

        return back()->with('success', 'Friend request cancelled.');
    }

    // ACCEPT FRIEND REQUEST
    public function accept($id)
    {
        $friendRequest = FriendRequest::findOrFail($id);

        if ($friendRequest->receiver_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        if ($friendRequest->status !== 'pending') {
            return back()->with('error', 'This request is no longer pending.');
        }

        DB::transaction(function () use ($friendRequest) {
            $friendRequest->update(['status' => 'accepted']);

            $sender = User::find($friendRequest->sender_id);
            $receiver = User::find($friendRequest->receiver_id);

            if (!$sender->friends()->where('friend_id', $receiver->id)->exists()) {
                $sender->friends()->attach($receiver->id);
            }
            if (!$receiver->friends()->where('friend_id', $sender->id)->exists()) {
                $receiver->friends()->attach($sender->id);
            }
        });

        return back()->with('success', 'Friend request accepted!');
    }

    // REJECT FRIEND REQUEST 
    public function reject($id)
    {
        $request = FriendRequest::findOrFail($id);

        if ($request->receiver_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        if ($request->status !== 'pending') {
            return back()->with('error', 'This request is no longer pending.');
        }

        $request->delete();

        return back()->with('success', 'Friend request rejected.');
    }

    // UNFRIEND
    public function unfriend($userId)
    {
        $currentUser = auth()->user();

        if (!$currentUser->isFriendsWith($userId)) {
            return back()->with('error', 'You are not friends with this user.');
        }

        DB::transaction(function () use ($currentUser, $userId) {
            $currentUser->friends()->detach($userId);
            User::find($userId)->friends()->detach($currentUser->id);

            FriendRequest::where(function ($query) use ($currentUser, $userId) {
                $query->where('sender_id', $currentUser->id)
                    ->where('receiver_id', $userId);
            })->orWhere(function ($query) use ($currentUser, $userId) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', $currentUser->id);
            })->delete();
        });

        return back()->with('success', 'Friend removed successfully.');
    }
}