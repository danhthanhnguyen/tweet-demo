<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct() {

        $this->middleware(['auth']);
    }

    public function index() {

        $tweets = DB::table("users")
                                    ->rightJoin("tweets", "users.id", "=", "tweets.user_id")
                                    ->leftJoin("likes", [
                                        ["tweets.id", "=", "likes.tweet_id"], ["likes.user_id", "=", DB::raw(Auth::user()->id)]
                                    ])
                                    ->select("users.name", "avatar", "full_name", "tweets.*", "likes.id as like_id")
                                    ->orderBy("tweets.id", "desc")
                                    ->get();

        $likes = DB::table("likes")
                                    ->groupBy("tweet_id")
                                    ->select("tweet_id", DB::raw("count(*) as like_counter"))
                                    ->orderBy("tweet_id", "desc")
                                    ->get();

        return view('layout.tweet', ['tweets' => $tweets, 'likes' => $likes]);
    }
}
