<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;


class UserController extends Controller
{
     public function index()
    {
         $user = User::all();
         return response()->json($user,200);
    }

     public function login(Request $request ){
        $data = User::where('email',$request->input('email'))->count();
        $data1 = DB::table('users')->where('email',$request->input('email'))->get();

        if($data == 0){
            return response()->json('email kamu tidak terdaftar ', 401);
        }
        else{
            return response()->json($data1, 200) ;
        }
    }
}
