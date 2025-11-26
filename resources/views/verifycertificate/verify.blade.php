@extends('layouts.app')

@section('title', 'Verify Certificate')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-10 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-5 text-center">Verify Your Certificate</h2>

        <p class="text-gray-600 mb-4">We need to verify your uploaded certificate for:</p>
        <ul class="mb-5 text-gray-700">
            <li><strong>Pet Name:</strong> {{ $user->pet_name }}</li>
            <li><strong>Breed:</strong> {{ $user->pet_breed }}</li>
            <li><strong>Age:</strong> {{ $user->pet_age }}</li>
            <li><strong>Gender:</strong> {{ $user->pet_gender }}</li>
        </ul>

        <p class="text-gray-600 mb-4">Uploaded file:</p>
        <a href="{{ asset('storage/' . $user->certificate_path) }}" target="_blank" class="text-blue-600 underline mb-5 block">
            View Certificate
        </a>
@if($errors->has('certificate'))
    <div class="text-red-600 mb-4">
        {{ $errors->first('certificate') }}
    </div>
@endif

        <form action="{{ route('verifycertificate.verify') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
                Verify Certificate
            </button>
        </form>
    </div>
</div>
@endsection
