<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login'); // Points to the 'login.blade.php' file in the 'resources/views/auth' directory
    }

    // Handle user login
    public function login(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect to the dashboard or intended page after successful login
            return redirect()->route('dashboard');
        }

        // If login fails, redirect back with an error message
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Handle user logout
    public function logout()
    {
        Auth::logout(); // Log the user out
        return redirect()->route('login'); // Redirect to login page
    }
}
