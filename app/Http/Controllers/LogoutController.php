<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __construct() {

        $this->middleware(['auth']);
    }

    public function store(Request $request) {

        Auth::logout();
        $request->session()->invalidate();//invalidate user's session
        $request->session()->regenerateToken();//regenerate csrf token
        return redirect()->route('home');
    }
}
