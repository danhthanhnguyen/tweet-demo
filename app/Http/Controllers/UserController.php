<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct() {

        return $this->middleware(['auth']);
    }

    public function index($userName) {

        $user = DB::table("users")->where("name", "=", $userName)->get();

        if (!$user->count()) {
            return view('layout.user', [
                'user' => null
            ]);
        }

        $tweets = DB::table("users")
                                    ->rightJoin("tweets", "users.id", "=", "tweets.user_id")
                                    ->leftJoin("likes", [
                                        ["tweets.id", "=", "likes.tweet_id"], ["likes.user_id", "=", DB::raw(Auth::user()->id)]
                                    ])
                                    ->select("name", "avatar", "full_name", "tweets.*", "likes.id as like_id")
                                    ->where("users.name", "=", $userName)
                                    ->orderBy("tweets.id", "desc")
                                    ->get();

        $likes = DB::table("likes")
                                    ->groupBy("tweet_id")
                                    ->select("tweet_id", DB::raw("count(*) as like_counter"))
                                    ->orderBy("tweet_id", "desc")
                                    ->get();

        $id = DB::table("users")->select("id")->where("name", "=", $userName)->get();

        $followed = DB::table("follows")
                                        ->select("id")
                                        ->where([
                                            ["user_id", "=", DB::raw(Auth::user()->id)],
                                            ["follow_id", "=", $id[0]->id]
                                        ])->get();

        $follower = DB::table("follows")->where("follow_id", "=", $user[0]->id)->count();
        $following = DB::table("follows")->where("user_id", "=", $user[0]->id)->count();

        return view('layout.user', [
            'user' => $user,
            'tweets' => $tweets,
            'likes' => $likes,
            'followed' => $followed,
            'follower' => $follower,
            'following' => $following
        ]);
    }

    public function tooltip(Request $request) {
        $user = DB::table("users")
                                    ->where("name", "=", $request->get('userName'))
                                    ->select("id", "full_name", "name", "bio", "avatar")
                                    ->first();
        $follower = DB::table("follows")->where("follow_id", "=", $user->id)->count();
        $following = DB::table("follows")->where("user_id", "=", $user->id)->count();
        $user->following = $following;
        $user->follower = $follower;
        return json_encode($user);
    }
}
