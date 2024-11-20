<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    // Show the registration form
    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    // Handle the registration request
    public function register(Request $request)
    {
        // Validate the form data
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Create a new user
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Log the user in
        auth()->login($user);
        // Redirect to dashboard
        return redirect('/');
    }
}




