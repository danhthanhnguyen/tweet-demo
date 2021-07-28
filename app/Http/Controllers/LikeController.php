<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function __construct() {

        return $this->middleware(['auth']);
    }

    public function store(Request $request) {
        
        if ($request->get('status') == "true") {// like tweet
            DB::table("likes")->insert([
                'user_id' => Auth::user()->id,
                'tweet_id' => $request->get('tweet_id'),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ]);
        } else {// unlike tweet
            DB::table("likes")->where([
                ['user_id', '=', Auth::user()->id],
                ['tweet_id', '=', $request->get('tweet_id')]
            ])->delete();
        }
        return DB::table("likes")->where("tweet_id", "=", $request->get('tweet_id'))->count();
    }

    public function delete(Request $request) {
        DB::table("tweets")
                            ->where([["id", "=", $request->get("id")]])
                            ->delete();
        return "This tweet was deleted!";
    }
}
