@extends('navbar.nav')
@section('title', 'Edit Profile - Waggy')
@section('body-class', 'bg-gray-900')

@section('content')

<div class="settings-page">

    <!-- Full width container with proper spacing -->
    <div class="edit-container" 
         style="max-width: 100%; padding: 5px 15px;">

        <!-- Header -->
        <div class="d-flex align-items-center gap-3 mb-5">
            <a href="{{ route('account') }}"
               class="btn p-0 border-0 text-white d-flex align-items-center"
               style="font-size: 25px;">
                <i class="bi bi-chevron-left"></i>
            </a>
            <h1 class="text-white fw-bold m-0" style="font-size: 25px;">Edit Profile</h1>
        </div>

        <!-- Form -->
        <form action="{{ route('editprofile.update') }}" method="POST" enctype="multipart/form-data" class="text-white">
            @csrf
            @method('PUT')

            {{-- Avatar --}}
            <div class="text-center mb-5 mt-4">
                <div class="avatar-wrapper">
    <img id="avatarPreview"
         src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/usericon.png') }}"
         style="width: 140px; height: 140px; border-radius: 50%; object-fit: cover;">
</div>
    
                <div class="mt-4">
                    <label class="btn btn-outline-light px-4 py-2" style="font-size: 15px;">
                        Change Photo
                        <input type="file" name="avatar" hidden>
                    </label>
                </div>
            </div>

            {{-- Pet Name --}}
            <div class="mb-4">
                <label class="form-label mb-2" style="font-size: 15px;">Pet Name</label>
                <input type="text" name="pet_name" 
                       class="form-control bg-dark text-white border-secondary"
                       style="padding: 12px 16px; font-size: 15px;"
                       value="{{ auth()->user()->pet_name }}">
            </div>

            {{-- Pet Breed --}}
            <div class="mb-4">
                <label class="form-label mb-2" style="font-size: 15px;">Pet Breed</label>
                <input type="text" name="pet_breed" 
                       class="form-control bg-dark text-white border-secondary"
                       style="padding: 12px 16px; font-size: 15px;"
                       value="{{ auth()->user()->pet_breed }}">
            </div>

            {{-- Pet Age --}}
            <div class="mb-4">
                <label class="form-label mb-2" style="font-size: 15px;">Pet Age</label>
                <input type="number" name="pet_age" 
                       class="form-control bg-dark text-white border-secondary"
                       style="padding: 12px 16px; font-size: 15px;"
                       value="{{ auth()->user()->pet_age }}">
            </div>

            {{-- Pet Gender --}}
            <div class="mb-4">
                <label class="form-label mb-2" style="font-size: 15px;">Pet Gender</label>
                <select name="pet_gender" 
                        class="form-select bg-dark text-white border-secondary"
                        style="padding: 12px 16px; font-size: 15px;">
                    <option value="Male" {{ auth()->user()->pet_gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ auth()->user()->pet_gender == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            {{-- Pet Features --}}
            <div class="mb-4">
                <label class="form-label mb-2" style="font-size: 15px;">Pet Features</label>
                <textarea name="pet_features" rows="4"
                          class="form-control bg-dark text-white border-secondary"
                          style="padding: 12px 16px; font-size: 15px;">{{ auth()->user()->pet_features }}</textarea>
            </div>

            {{-- Save --}}
            <button class="btn btn-primary w-100 mt-5 py-3" style="font-size: 16px; font-weight: 600;">Save Changes</button>

        </form>

    </div>
</div>
<script>
document.querySelector('input[name="avatar"]').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    let imgPreview = document.querySelector('#avatarPreview');

    // Kung wala pang preview ID, gawin natin
    if (!imgPreview) {
        imgPreview = document.querySelector('.avatar-wrapper img');
        imgPreview.id = "avatarPreview";
    }

    imgPreview.src = URL.createObjectURL(file);
});
</script>

@endsection