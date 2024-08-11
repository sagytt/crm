<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return inertia('Auth/Login');
    }

    public function registration(){
        return inertia('Auth/Register');
    }

    public function store(Request $request){

        $rules = [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]*$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:8'],
        ];
        $messages = [
            'name.required' => 'The name field is required.',
            'name.regex' => 'The name can only contain letters and spaces.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'The password field is required.',
            'phone_number.regex' => 'The password should be min 8 character long.',
        ];

        $request->validate($rules, $messages);

        $customer = User::create([
            'name' => $request->name,
            'email_verified_at' => now(),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
         
        return redirect()->route('login')
        ->with('success', 'User created successfully!');
    }

    public function autenticateUser(Request $request){
       // Validate the request
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (!Auth::attempt($credentials, true)) {
            // Authentication failed, throw a validation exception with custom message
            throw ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }

        // Regenerate session to prevent session fixation attacks
        $request->session()->regenerate();

        // Redirect to the intended page
        return redirect()->route('managecustomer');
    }

    public function logoutUser(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
