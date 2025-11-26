@extends('navbar.nav')

@section('title', 'Delete Account')

@section('content')

<div class="d-flex align-items-center gap-3 mb-4">
    <button class="btn p-0 border-0 text-white d-flex align-items-center" id="backButton"
        style="font-size: 25px;">
        <i class="bi bi-chevron-left"></i>
    </button>
    <h1 class="text-white fw-bold m-0" style="font-size: 25px;">Delete Account</h1>
</div>

<div class="d-flex justify-content-center">
    <div style="max-width: 400px; width: 100%; position: relative; margin-top: 80px;">

        <div class="mb-4">
            <p class="text-white" style="font-size: 15px; line-height: 1.6;">
                Are you sure you want to delete your account?<br>
                This action cannot be undone.
            </p>
        </div>

        <!-- DELETE ACCOUNT FORM -->
        <form method="POST" action="{{ route('delete-account') }}">
            @csrf

            <div class="mb-4">
                <input 
                    type="password" 
                    name="password" 
                    class="form-control border-0 rounded-3" 
                    placeholder="Password" 
                    required
                    style="padding: 10px 14px; font-size: 14px; background-color: #ffffff; color: #2d3748;">
            </div>

            <div class="row g-3 mt-3">
                <div class="col-12 col-md-6">
                    <button type="submit" class="btn w-100 rounded-3 fw-semibold"
                        style="padding: 10px 20px; font-size: 15px; background-color: #ef4444; color: #ffffff; border: none;">
                        Delete Account
                    </button>
                </div>

                <div class="col-12 col-md-6">
                    <button type="button" class="btn w-100 rounded-3 fw-semibold" id="btnCancel"
                        style="padding: 10px 20px; font-size: 15px; background-color: #4a5568; color: #ffffff; border: none;">
                        Cancel
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
    // Back button
    document.getElementById('backButton').addEventListener('click', () => {
        window.history.back();
    });

    // Cancel button
    document.getElementById('btnCancel').addEventListener('click', function () {
        if (confirm('Cancel account deletion?')) {
            window.history.back();
        }
    });
</script>

@endsection
