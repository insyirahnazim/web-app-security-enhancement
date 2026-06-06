<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register'); // Points to the 'register.blade.php' file in the 'resources/views/auth' directory
    }

    // Handle user registration
    public function register(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed', // Confirm password field
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        // Log the user in immediately after registration
        auth()->login($user);

        // Redirect to the desired location (e.g., user dashboard)
        return redirect()->route('dashboard');
    }
}
