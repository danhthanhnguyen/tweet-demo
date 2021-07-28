<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function __construct() {

        return $this->middleware(["auth"]);
    }

    public function store(Request $request, $user) {
        $id = DB::table("users")->select("id")->where("name", "=", $request->get('user'))->get();
        $followed = DB::table("follows")
                                        ->select("id")
                                        ->where([
                                            ["user_id", "=", DB::raw(Auth::user()->id)],
                                            ["follow_id", "=", $id[0]->id]
                                        ])->get();
        if(!$followed->count()) {
            DB::table("follows")->insert([
                "user_id" => Auth::user()->id,
                "follow_id" => $id[0]->id,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ]);
            return "Following";
        } else {
            DB::table("follows")->where([
                ['user_id', '=', Auth::user()->id],
                ['follow_id', '=', $id[0]->id]
            ])->delete();
            return "Follow";
        }
    }
}
