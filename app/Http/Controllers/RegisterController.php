<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct() {

        $this->middleware(['guest']);
    }

    public function index() {

        return view('auth.register');
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|alpha_dash|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        //create new account
        DB::table('users')->insert([
            'full_name' => $request->name,
            'avatar' => 'uploads/PAI4oFIp8XB8X5nMGfJg3hT1VBJ0ijhwXUes2o55.png',
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ]);
        //sign in now
        Auth::attempt($request->only(['email', 'password']));
        //redirect to home page
        return redirect()->route('home');
    }
}
