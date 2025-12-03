@extends('navbar.nav1')
@section('title', 'Friend Requests - Waggy')
@section('body-class', 'bg-gray-900')
@section('content')

    <div class="min-h-screen bg-gray-900 text-white p-8">
        <h1 class="text-3xl font-bold mb-6">Friend Requests</h1>

        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
        @endif

        <div class="space-y-4">
            @forelse($friendRequests as $request)
                <div class="bg-gray-800 rounded-lg p-6 flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $request->sender->avatar ? asset('storage/' . $request->sender->avatar) : asset('assets/usericon.png') }}"
                            class="w-16 h-16 rounded-full object-cover">
                        <div>
                            <h3 class="font-bold text-lg">{{ $request->sender->pet_name ?? $request->sender->name }}</h3>
                            <p class="text-sm text-gray-400">
                                <i class="bi bi-tag"></i> {{ $request->sender->pet_breed ?? 'No breed' }}
                            </p>
                            @if($request->sender->city && $request->sender->province)
                                <p class="text-sm text-gray-400">
                                    <i class="bi bi-geo-alt"></i> {{ $request->sender->city }}, {{ $request->sender->province }}
                                </p>
                            @endif
                            <small class="text-gray-500">{{ $request->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <form action="{{ route('friend-requests.accept', $request->id) }}" method="POST">
                            @csrf
                            <button class="px-6 py-2 bg-blue-600 rounded-lg hover:bg-blue-700">Accept</button>
                        </form>
                        <form action="{{ route('friend-requests.reject', $request->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="px-6 py-2 bg-gray-700 rounded-lg hover:bg-gray-600">Reject</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-gray-800 rounded-lg p-6 text-center">
                    <p class="text-gray-400">No pending friend requests</p>
                </div>
            @endforelse
        </div>
    </div>

@endsection