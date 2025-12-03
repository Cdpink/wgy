<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'pet_name',
        'pet_breed',
        'pet_age',
        'pet_gender',
        'pet_features',
        'certificate_verified',
        'certificate_path'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_online' => 'boolean',
            'certificate_verified' => 'boolean',
            'last_seen' => 'datetime',
        ];
    }

    // Relationships
    public function dog()
    {
        return $this->hasOne(Dog::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function sentFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'sender_id');
    }

    public function receivedFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id');
    }

    public function friends()
    {
        return $this->belongsToMany(
            User::class,
            'friends',
            'user_id',
            'friend_id'
        )->withTimestamps();
    }

    /**
     * Check if users are friends (accepted friend request)
     */
    public function isFriendsWith($userId)
    {
        return $this->friends()->where('friend_id', $userId)->exists();
    }
    public function hasSentPendingRequestTo($userId)
    {
        return FriendRequest::where('sender_id', $this->id)
            ->where('receiver_id', $userId)
            ->where('status', 'pending')
            ->exists();
    }

    /**
     * Check if current user received a pending friend request from target user
     */
    public function hasReceivedPendingRequestFrom($userId)
    {
        return FriendRequest::where('sender_id', $userId)
            ->where('receiver_id', $this->id)
            ->where('status', 'pending')
            ->exists();
    }

    /**
     * Get the friend request sent by current user to target user (if exists)
     */
    public function getPendingRequestTo($userId)
    {
        return FriendRequest::where('sender_id', $this->id)
            ->where('receiver_id', $userId)
            ->where('status', 'pending')
            ->first();
    }

    /**
     * Get friend relationship status with another user
     * Returns: 'friends', 'pending_sent', 'pending_received', 'none'
     */
    public function getFriendshipStatus($userId)
    {
        if ($this->isFriendsWith($userId)) {
            return 'friends';
        }

        if ($this->hasSentPendingRequestTo($userId)) {
            return 'pending_sent';
        }

        if ($this->hasReceivedPendingRequestFrom($userId)) {
            return 'pending_received';
        }
        return 'none';
    }

    public function isFriendWith(User $user): bool
    {
        return $this->friends()->where('friend_id', $user->id)->exists();
    }

    public function mutualFriends(User $user)
    {
        $myFriends = $this->friends()->pluck('friend_id')->toArray();
        $otherFriends = $user->friends()->pluck('friend_id')->toArray();
        $mutualIds = array_intersect($myFriends, $otherFriends);
        return self::whereIn('id', $mutualIds)->get();
    }
}