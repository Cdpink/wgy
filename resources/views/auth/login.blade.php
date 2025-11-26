@extends('layouts.app')
@section('title', 'Login - Waggy')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#f5f5f7] px-6 relative">

  {{-- Back to Waggy link --}}
  <a href="{{ route('landing') }}" 
   class="absolute top-8 right-8 text-blue-600 hover:text-blue-700 text-sm font-medium">
    Back to Waggy
</a>


  <div class="flex flex-col md:flex-row w-full max-w-5xl items-center justify-center">

    {{-- Left Section --}}
    <div class="md:w-1/2 text-center md:text-left mb-10 md:mb-0 px-6">
      <h1 class="text-4xl font-bold text-blue-600 mb-3">Waggy</h1>
      <p class="text-gray-600 text-base leading-relaxed max-w-xs mx-auto md:mx-0">
        Connect, share, and grow with<br>
        responsible breeders on Waggy.
      </p>
    </div>

    {{-- Right Section (Login Card) --}}
    <div class="md:w-1/2 bg-white rounded-2xl shadow-md p-10 w-full max-w-sm">

      @if($errors->any())
      <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
        {{$errors->first()}}
      </div>
      @endif

      <form class="space-y-5" action="{{route('login.post')}}" method="POST">
        @csrf

        <div>
          <label for="email" class="block text-gray-600 mb-1 text-sm font-medium">Email</label>
          <input type="email" id="email" name="email" required
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                 placeholder="Email" value="{{old('email')}}">
        </div>

        <div>
          <label for="password" class="block text-gray-600 mb-1 text-sm font-medium">Password</label>
          <input type="password" id="password" name="password" required
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                 placeholder="Password">
        </div>

        <div class="flex justify-end">
          <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold rounded-lg py-3 text-base hover:bg-blue-700 transition">
          Login
        </button>

        <p class="text-center text-gray-500 text-sm pt-2">
          Don't have an account?
          <a href="{{route('signup')}}" class="text-blue-600 hover:text-blue-700 font-medium">Sign up</a>
        </p>
      </form>
    </div>
  </div>
</div>
@endsection
