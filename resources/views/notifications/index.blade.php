@extends('navbar.nav')
@section('title', 'Notifications - Waggy')
@section('body-class', 'bg-gray-900')
@section('content')
<div class="min-h-screen bg-gray-900 text-white p-8">
    <h1 class="text-3xl font-bold mb-6">Notifications</h1>
    <div class="space-y-4">
        @foreach($notifications as $notification)
        <div class="bg-gray-800 rounded-lg p-6">
            <p>{{$notification->message}}</p>
            <span class="text-sm text-gray-400">{{$notification->created_at->diffForHumans()}}</span>
        </div>
        @endforeach
    </div>
</div>
@endsection
