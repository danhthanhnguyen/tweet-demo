<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TweetController extends Controller
{
    public function __construct() {

        return $this->middleware(['auth']);
    }

    public function store(Request $request) {

        $request->validate([
            'tweet' => 'required'
        ]);

        DB::table("tweets")->insert([
            'user_id' => Auth::user()->id,
            'tweet' => $request->tweet,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ]);

        return back();
    }
}
