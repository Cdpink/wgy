<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showSignup(Request $request)
    {
        $user = $request->user();
        return view('auth.signup', [
            'certificate_path' => $user->certificate_path ?? null,
            'certificate_name' => null,
        ]);
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (!auth()->user()->certificate_verified) {
                return redirect()->route('certificate');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'pet_name' => 'required|string',
            'breedtype' => 'required|string',
            'dog_age' => 'required|numeric',
            'gendertype' => 'required|string',
            'features' => 'nullable|string',
            'certificate' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        // Upload certificate file if present
        $certificatePath = null;
        if ($request->hasFile('certificate')) {
            $certificatePath = $request->file('certificate')->store('certificates', 'public');
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),

            // Pet details (matching your DB)
            'pet_name' => $request->pet_name,
            'pet_breed' => $request->breedtype,
            'pet_age' => $request->dog_age,
            'pet_gender' => $request->gendertype,
            'pet_features' => $request->features,

            // Certificate
            'certificate_path' => $certificatePath,
            'certificate_verified' => false,
        ]);

        Auth::login($user);

        // Redirect based on certificate verification status
        if (!$user->certificate_verified) {
            return redirect()->route('certificate');
        }

        return redirect()->route('home');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
