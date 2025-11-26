@extends('navbar.nav') {{-- Use your main app layout --}}
@section('title', 'Settings - Waggy')
@section('body-class', 'bg-gray-900')

@section('content')


<!-- MAIN CONTENT -->
<div class="setting-page">
    <!-- Main Settings View -->
    <div class="view" id="viewMainSettings">
        <div class="d-flex align-items-center gap-3 mb-5">
            <button class="btn p-0 border-0 text-white d-flex align-items-center" id="backButtonMain" style="font-size: 25px;">
                <i class="bi bi-chevron-left"></i>
            </button>
            <h1 class="text-white fw-bold m-0" style="font-size: 25px;">Settings</h1>
        </div>

        <div class="d-flex flex-column" style="max-width: 800px;">
            <a href="{{ route('account') }}" class="btn text-white text-start border-0 p-0 py-3 text-decoration-none" id="optionAccount" style="font-size: 20px; font-weight: 400; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                Account
            </a>

            <a href="{{ route('guideline') }}" class="btn text-white text-start border-0 p-0 py-3 text-decoration-none" id="optionPrivacy" style="font-size: 20px; font-weight: 400; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                Privacy
            </a>

            <a href="{{ route('discover') }}" class="btn text-white text-start border-0 p-0 py-3 text-decoration-none" id="optionAccessibility" style="font-size: 20px; font-weight: 400;">
                Accessibility
            </a>
        </div>
    </div>

    <!-- Account Settings View -->
    <div class="view" id="viewAccountSettings" style="display: none;">
        <div class="d-flex align-items-center gap-3 mb-5">
            <button class="btn p-0 border-0 text-white d-flex align-items-center" id="backButtonAccount" style="font-size: 25px;">
                <i class="bi bi-chevron-left"></i>
            </button>
            <h1 class="text-white fw-bold m-0" style="font-size: 25px;">Account</h1>
        </div>

        <div class="d-flex flex-column" style="max-width: 800px;">
            <a href="{{ route('editprofile') }}" class="btn text-white text-start border-0 p-0 py-3 text-decoration-none" id="optionEditProfile" style="font-size: 20px; font-weight: 400; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                Edit Profile
            </a>

            <a href="{{ route('changepassword') }}" class="btn text-white text-start border-0 p-0 py-3 text-decoration-none" id="optionChangePassword" style="font-size: 20px; font-weight: 400; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                Change Password
            </a>

            <a href="{{ route('delete-account') }}" class="btn text-white text-start border-0 p-0 py-3 text-decoration-none" id="optionDeleteAccount" style="font-size: 20px; font-weight: 400;">
                Delete Account
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Your existing JS for dropdowns and view switching
    document.addEventListener('DOMContentLoaded', function () {
        const profileDropdown = document.getElementById('profileDropdown');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const profileDropdownContainer = document.getElementById('profileDropdownContainer');

        profileDropdown.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
        });

        document.addEventListener('click', function (e) {
            if (!profileDropdownContainer.contains(e.target)) {
                dropdownMenu.style.display = 'none';
            }
        });

        function showView(viewId) {
            document.querySelectorAll('.view').forEach(v => v.style.display = 'none');
            document.getElementById(viewId).style.display = 'block';
        }

        document.getElementById('backButtonMain').addEventListener('click', () => window.history.back());
        document.getElementById('backButtonAccount').addEventListener('click', () => showView('viewMainSettings'));
        document.getElementById('optionAccount').addEventListener('click', () => showView('viewAccountSettings'));
    });
</script>
@endpush
@endsection
