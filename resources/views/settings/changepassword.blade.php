@extends('navbar.nav') 
{{-- make sure your main layout is named layouts.app or change it accordingly --}}

@section('title', 'Waggy - Change Password')

@section('content')

<div class="change-password page">

     <!-- Header -->
        <div class="d-flex align-items-center gap-3 mb-5">
            <a href="{{ route('account') }}"
               class="btn p-0 border-0 text-white d-flex align-items-center"
               style="font-size: 25px;">
                <i class="bi bi-chevron-left"></i>
            </a>
            <h1 class="text-white fw-bold m-0" style="font-size: 25px;">Change Password</h1>
        </div>

    <!-- Change Password Form -->
    <div class="d-flex justify-content-center">
        <div style="max-width: 400px; width: 100%; position:relative; margin-top:80px">

            <form id="changePasswordForm" method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <input type="password" name="current_password" class="form-control border-0 rounded-3"
                        placeholder="Current Password" required
                        style="padding: 10px 14px; font-size:14px; background:white; color:#2d3748;">
                    <div class="text-danger small mt-2">
                        @error('current_password') {{ $message }} @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control border-0 rounded-3"
                        placeholder="New Password" required
                        style="padding: 10px 14px; font-size:14px; background:white; color:#2d3748;">
                    <div class="text-danger small mt-2">
                        @error('password') {{ $message }} @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control border-0 rounded-3"
                        placeholder="Confirm New Password" required
                        style="padding: 10px 14px; font-size:14px; background:white; color:#2d3748;">
                </div>

                <!-- Buttons -->
                <div class="row g-3 mt-3">
                    <div class="col-12 col-md-6">
                        <button type="submit" class="btn w-100 rounded-3 fw-semibold"
                            style="padding: 10px 20px; font-size:15px; background:#4299e1; color:white; border:none;">
                            Change Password
                        </button>
                    </div>
                    <div class="col-12 col-md-6">
                        <button type="button" class="btn w-100 rounded-3 fw-semibold" id="btnCancel"
                            style="padding: 10px 20px; font-size:15px; background:#4a5568; color:white; border:none;">
                            Cancel
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection


@section('scripts')
<script>
// Back button
document.getElementById('backButton').addEventListener('click', () => {
    window.history.back();
});

// Cancel button
document.getElementById('btnCancel').addEventListener('click', function () {
    if (confirm('Discard changes?')) {
        window.history.back();
    }
});
</script>
@endsection
