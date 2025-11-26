<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dog;
use App\Models\Location;
use App\Models\FriendRequest;
use App\Models\Post;
use App\Models\Message;
use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $locations = [
            ['city' => 'London', 'state' => 'England', 'country' => 'UK'],
            ['city' => 'Paris', 'state' => 'Île-de-France', 'country' => 'France'],
            ['city' => 'New York', 'state' => 'New York', 'country' => 'USA'],
            ['city' => 'Los Angeles', 'state' => 'California', 'country' => 'USA'],
            ['city' => 'Tokyo', 'state' => 'Tokyo', 'country' => 'Japan'],
        ];

        foreach ($locations as $loc) {
            Location::create($loc);
        }

        $user1 = User::create([
            'name' => 'Luna',
            'email' => 'luna@waggy.com',
            'password' => Hash::make('luna1234'),
            'is_online' => true,
            'certificate_verified' => true,
        ]);

        $user2 = User::create([
            'name' => 'Max',
            'email' => 'max@waggy.com',
            'password' => Hash::make('password'),
            'is_online' => false,
            'certificate_verified' => true,
        ]);

        $user3 = User::create([
            'name' => 'Bella',
            'email' => 'bella@waggy.com',
            'password' => Hash::make('password'),
            'is_online' => true,
            'certificate_verified' => true,
        ]);

        $user4 = User::create([
            'name' => 'Charlie',
            'email' => 'charlie@waggy.com',
            'password' => Hash::make('password'),
            'is_online' => true,
            'certificate_verified' => true,
        ]);

        $user5 = User::create([
            'name' => 'Demo User',
            'email' => 'demo@waggy.com',
            'password' => Hash::make('password'),
            'is_online' => false,
            'certificate_verified' => false,
        ]);

        Dog::create([
            'user_id' => $user1->id,
            'location_id' => 1,
            'name' => 'Leo',
            'age' => 3,
            'breed' => 'Golden Retriever',
            'bio' => 'Friendly and loves to play!',
            'status' => 'available',
        ]);

        Dog::create([
            'user_id' => $user2->id,
            'location_id' => 2,
            'name' => 'Nala',
            'age' => 2,
            'breed' => 'Shih Tzu',
            'bio' => 'Cute and cuddly companion',
            'status' => 'available',
        ]);

        Dog::create([
            'user_id' => $user3->id,
            'location_id' => 3,
            'name' => 'Bella',
            'age' => 5,
            'breed' => 'Labrador Retriever',
            'bio' => 'Loves swimming and fetch',
            'status' => 'busy',
        ]);

        Dog::create([
            'user_id' => $user4->id,
            'location_id' => 4,
            'name' => 'Daisy',
            'age' => 4,
            'breed' => 'Pomeranian',
            'bio' => 'Energetic and playful',
            'status' => 'available',
        ]);

        FriendRequest::create([
            'sender_id' => $user2->id,
            'receiver_id' => $user1->id,
            'status' => 'pending',
        ]);

        FriendRequest::create([
            'sender_id' => $user3->id,
            'receiver_id' => $user1->id,
            'status' => 'pending',
        ]);

        Post::create([
            'user_id' => $user1->id,
            'content' => 'Had a great day at the park with Leo!',
            'likes_count' => 5,
        ]);

        Post::create([
            'user_id' => $user2->id,
            'content' => 'Nala loves her new toy!',
            'likes_count' => 3,
        ]);

        Notification::create([
            'user_id' => $user1->id,
            'actor_id' => $user2->id,
            'type' => 'connect',
            'message' => 'Bella wants to connect with you',
        ]);

        Notification::create([
            'user_id' => $user1->id,
            'actor_id' => $user3->id,
            'type' => 'like',
            'message' => 'Milo liked your post',
        ]);
    }
}
