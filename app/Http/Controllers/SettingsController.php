<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\DogPhoto;
class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.setting');
    }

    public function accounts()
    {
        return view('settings.account');
    }

   public function editProfile()
{
    return view('settings.editprofile');
}


    public function changePassword()
    {
        return view('settings.changepassword');
    }

    public function deleteAccount()
    {
        return view('settings.deleteaccount');
    }

    public function updateProfile(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'avatar' => 'nullable|image|max:2048',
        'pet_name' => 'nullable|string',
        'pet_breed' => 'nullable|string',
        'pet_age' => 'nullable|integer',
        'pet_gender' => 'nullable|string',
        'pet_features' => 'nullable|string',
    ]);

    // Avatar upload
    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');

        // Update the main avatar of the user
        $user->avatar = $path;

        // Save the uploaded image to dog_photos table
        DogPhoto::create([
            'user_id' => $user->id,
            'image_path' => $path
        ]);
    }

    // Update pet details
    $user->pet_name = $request->pet_name;
    $user->pet_breed = $request->pet_breed;
    $user->pet_age = $request->pet_age;
    $user->pet_gender = $request->pet_gender;
    $user->pet_features = $request->pet_features;

    $user->save();

    return redirect()->back()->with('success', 'Profile updated!');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = auth()->user();

    // Check current password
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect']);
    }

    // Change password
    $user->password = Hash::make($request->password);
    $user->save();

    return back()->with('success', 'Password updated successfully!');
}

}
