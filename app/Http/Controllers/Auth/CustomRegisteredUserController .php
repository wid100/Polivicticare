<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class CustomRegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        // Generate a unique 6-digit UID
        do {
            $uid = Str::random(6);
        } while (User::where('uid', $uid)->exists());
        $user = User::create([
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'uid' => $uid,

        ]);

        event(new Registered($user));

        // Only log in the user if their email is verified
        if ($user->email_verified_at) {
            Auth::login($user);
            return response()->json([
                'message' => 'Registration successful and logged in',
                'redirect' => route('home'), // Adjust the route as needed
            ], 200);
        }

        return response()->json([
            'message' => 'Registration successful. Please verify your email before logging in.',
        ], 201);
    }
}
