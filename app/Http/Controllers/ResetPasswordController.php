<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function __construct() {

        return $this->middleware(["guest"]);
    }

    public function index() {

        return view('auth.email');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $token = Str::random(60);// create token
        DB::table("password_resets")->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()->toDateTimeString()
        ]);

        // send mail
        Mail::send('auth.mailer', ["token" => $token], function($message) use($request) {
            $message->to($request->email);
            $message->subject("Reset password notification!");
        });

        return back()->with('status', 'We have e-mailed your password reset link!');
    }

    public function requests($token) {
        
        return view('auth.reset', ['token' => $token]);
    }

    public function reset(Request $request) {
        
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);
        $user = DB::table("password_resets")
                                            ->where([
                                                ['email', '=', $request->email],
                                                ['token', '=', $request->token]
                                            ])
                                            ->first();
        if(!$user) {
            return back()->with('status', 'Invalid token!');
        } else {
            DB::table("users")
                              ->where('email', '=', $request->email)
                              ->update(['password' => Hash::make($request->password)]);

            DB::table("password_resets")
                                        ->where("email", "=", $request->email)
                                        ->delete();

            return redirect()->route('login')->with('status', 'Your password has been changed!');
        }
    }
}
