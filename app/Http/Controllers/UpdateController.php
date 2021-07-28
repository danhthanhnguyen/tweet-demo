<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    public function __construct() {

        return $this->middleware(['auth']);
    }

    public function index() {

        $user = DB::table("users")->where("id", "=", Auth::user()->id)->first();

        return view('layout.update', ["user" => $user]);
    }
    
    public function update(Request $request) {
        
        $request->validate([
            "full-name" => "max:50",
            "avatar" => "image",
            "bio" => "max:160",
            "location" => "max:60"
        ]);
        // var_dump(strtotime($request->birthday));
        if($request->avatar) {
            $path = $request->avatar->store("uploads", "public");
            DB::table("users")
                            ->where("id", "=", DB::raw(Auth::user()->id))
                            ->update([
                                "full_name" => $request->full_name,
                                "avatar" => $path,
                                "bio" => $request->bio,
                                "location" => $request->location,
                                "birthday" => $request->birthday
                            ]);
        } else {
            DB::table("users")
                            ->where("id", "=", DB::raw(Auth::user()->id))
                            ->update([
                                "full_name" => $request->full_name,
                                "bio" => $request->bio,
                                "location" => $request->location,
                                "birthday" => $request->birthday
                            ]);
        }
        return redirect()->route('user', ['user' => Auth::user()->name]);
    }
}
