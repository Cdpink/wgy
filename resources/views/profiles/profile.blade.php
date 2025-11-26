@extends('navbar.nav')

@section('title', 'Profile')
@section('body-class', 'bg-gray-900 text-white')

@section('content')

<style>
    /* Remove Bootstrap blue highlight */
    .nav-tabs .nav-link.active {
        border: none !important;
        color: white !important;
    }

    .nav-tabs .nav-link {
        transition: 0.3s ease;
        border: none !important;
    }

    /* Hover effect */
    .nav-tabs .nav-link:hover {
        color: white !important;
        background: rgba(255, 255, 255, 0.08) !important;
        border-radius: 6px;
    }
</style>


<div class="profile-page">

    <div style="max-width: 1200px;">

        {{--  LARGE PROFILE HEADER --}}
        <div class="d-flex align-items-center gap-4 mb-4">
             <img src="{{ auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : asset('assets/usericon.png') }}"
                alt="{{ $user->name }}"
                class="rounded-circle"
                style="width: 120px; height: 120px; border: 4px solid #4a5568; object-fit: cover;">
            
            <div class="profile-info">
                <h6 class="text-white fw-semibold mb-2 fs-5">
                    {{ $user->pet_name ?? 'Pet Name' }}
                </h6>
                <small class="text-secondary fs-6">
                    {{ $user->pet_breed ?? 'Breed not set' }}
                </small>
            </div>
        </div>

        {{--  TABS --}}
        <div style="border-bottom: 2px solid #4a5568;" class="mb-4">
            <ul class="nav nav-tabs border-0 gap-1">

                {{-- MY POST TAB --}}
                <li class="nav-item">
                    <button class="nav-link border-0 px-4 py-3"
                        style="color:#a0aec0; background:none;"
                        data-bs-toggle="tab" data-bs-target="#content-my-post">
                        <i class="bi bi-grid-3x3" style="font-size:20px;"></i>
                        <span>My Post</span>
                    </button>
                </li>

                {{-- MY DOG TAB --}}
                <button class="nav-link border-0 px-4 py-3"
                        style="color:#a0aec0; background:none;"
                    data-bs-toggle="tab" data-bs-target="#content-my-dog">
                <i class="bi bi-person-circle" style="font-size:20px;"></i>
                <span>My Dog</span>
            </button>


                {{-- CONNECTION TAB --}}
                <li class="nav-item">
                    <button class="nav-link border-0 px-4 py-3"
                        style="color:#a0aec0; background:none;"
                        data-bs-toggle="tab" data-bs-target="#content-connection">
                        <i class="bi bi-people" style="font-size:20px;"></i>
                        <span>Connection</span>
                    </button>
                </li>

                {{-- LIKES TAB --}}
                <li class="nav-item">
                    <button class="nav-link border-0 px-4 py-3"
                        style="color:#a0aec0; background:none;"
                        data-bs-toggle="tab" data-bs-target="#content-likes">
                        <i class="bi bi-heart" style="font-size:20px;"></i>
                        <span>Likes</span>
                    </button>
                </li>

            </ul>
        </div>

        {{--  TAB CONTENT --}}
        <div class="tab-content">

        {{-- MY POSTS --}}
<div class="tab-pane fade" id="content-my-post">
    <div class="row g-1">

        @forelse ($posts as $post)
            <div class="col-lg-4 col-md-6 col-4">
                <div class="position-relative overflow-hidden"
                     style="aspect-ratio:1/1; cursor:pointer;">
                    
                    <img src="{{ $post->photo 
                                ? asset('storage/' . $post->photo)
                                : 'https://placehold.co/400x400?text=No+Photo' }}"
                         class="w-100 h-100"
                         style="object-fit:cover;">
                </div>
            </div>
        @empty
            <p class="text-secondary">No posts yet.</p>
        @endforelse

    </div>
</div>



            {{--  MY DOG TAB --}}
            <div class="tab-pane fade show active" id="content-my-dog">
            <div class="row g-1">

              @forelse ($dogPhotos as $photo)
    <div class="col-lg-4 col-md-6 col-4">
        <div class="position-relative overflow-hidden" style="aspect-ratio:1/1;">
            <img src="{{ asset('storage/' . $photo->image_path) }}"
                 class="w-100 h-100" style="object-fit:cover;">
        </div>
    </div>
@empty
    <p class="text-secondary">No dog photos uploaded yet.</p>
@endforelse

            </div>
        </div>

            {{--  CONNECTION TAB --}}
            <div class="tab-pane fade" id="content-connection">
                <div class="row g-1">
                    <p class="text-secondary">No connections yet.</p>
                </div>
            </div>

            {{--  LIKES TAB --}}
            <div class="tab-pane fade" id="content-likes">
                <div class="row g-1">
                    <p class="text-secondary">No liked posts yet.</p>
                </div>
            </div>

        </div>

    </div>
</div>

{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
