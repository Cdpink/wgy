<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DiscoverController;
use App\Http\Controllers\BreedingController;
use App\Http\Controllers\PlaydateController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (no login required)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {return view('landing.landing');})->name('landing');

Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'register'])->name('signup.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

/* PUBLIC PAGES */
Route::get('/discover', function () {
    return view('landing.discover');
})->name('discover');

Route::get('/guidelines', function () {
    return view('landing.guidelines');
})->name('guideline');

Route::get('/helpcenter', function () {
    return view('landing.helpcenter');
})->name('helpcenter');


/*
|--------------------------------------------------------------------------
| PRIVATE ROUTES (requires login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::get('/certificate', [CertificateController::class, 'index'])->name('certificate');
    Route::post('/certificate', [CertificateController::class, 'upload'])->name('verifycertificate.verify');

    Route::get('/breeding', [BreedingController::class, 'index'])->name('breeding');
    Route::get('/playdate', [PlaydateController::class, 'index'])->name('playdate');

    Route::get('/posting', [PostController::class, 'postingPage'])->name('posting.page');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/create-post', [PostController::class, 'create'])->name('posts.create');
    Route::post('/set-upload-session', [PostController::class, 'setUploadSession']);
    Route::get('/clear-upload-session', function () {session()->forget('uploaded_image');return response()->json(['cleared' => true]);});
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{id}/report', [PostController::class, 'report'])->name('posts.report');
    Route::post('/posts/{user_id}/block', [PostController::class, 'block'])->name('user.block');



    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/messages/{userId}', [MessageController::class, 'conversation'])->name('messages.conversation');
    Route::post('/messages/send', [MessageController::class, 'send'])->name('messages.send');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');

    Route::get('/settings', [SettingsController::class, 'index'])->name('setting');
    Route::get('/settings/edit-profile', [SettingsController::class, 'editProfile'])->name('editprofile');
    Route::put('/settings/edit-profile', [SettingsController::class, 'updateProfile'])->name('editprofile.update');

    Route::get('/settings/change-password', [SettingsController::class, 'changePassword'])->name('changepassword');
    Route::put('/settings/change-password', [SettingsController::class, 'updatePassword'])->name('password.update');

    Route::get('/settings/delete-account', [SettingsController::class, 'deleteAccount'])->name('delete-account');
    Route::get('/settings/accounts', [SettingsController::class, 'accounts'])->name('account');

    Route::get('/friend-requests', [FriendRequestController::class, 'index'])->name('friend-requests');
    Route::post('/friend-requests/{id}/accept', [FriendRequestController::class, 'accept'])->name('friend-requests.accept');
    Route::post('/friend-requests/{id}/reject', [FriendRequestController::class, 'reject'])->name('friend-requests.reject');
    Route::post('/friend-requests/send', [FriendRequestController::class, 'send'])->name('friend-requests.send');
});
