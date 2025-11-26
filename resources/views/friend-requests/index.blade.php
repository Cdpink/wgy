@extends('navbar.nav')
@section('title', 'Friend Requests - Waggy')
@section('body-class', 'bg-gray-900')
@section('content')
<div class="min-h-screen bg-gray-900 text-white p-8">
    <h1 class="text-3xl font-bold mb-6">Friend Requests</h1>
    <div class="space-y-4">
        @foreach($friendRequests as $request)
        <div class="bg-gray-800 rounded-lg p-6 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gray-600 rounded-full"></div>
                <div>
                    <h3 class="font-bold">{{$request->sender->dog->name ?? $request->sender->name}}</h3>
                    <p class="text-sm text-gray-400">{{$request->sender->dog->breed ?? 'Wants to connect'}}</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <form action="{{route('friend-requests.accept', $request->id)}}" method="POST">
                    @csrf
                    <button class="px-6 py-2 bg-blue-600 rounded-lg hover:bg-blue-700">Accept</button>
                </form>
                <form action="{{route('friend-requests.reject', $request->id)}}" method="POST">
                    @csrf
                    <button class="px-6 py-2 bg-gray-700 rounded-lg hover:bg-gray-600">Reject</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
