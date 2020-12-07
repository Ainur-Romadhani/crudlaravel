<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Todo;
use DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
     public function index(Request $request)
    {
      
        $user = User::all();
        return response()->json($user);
         
    }

    public function datauser(Request $request){
        $data1 = User::where('email', $request->input('email'))->get();
        $data = User::where('email', $request->input('email'))->count();
    
        if($data == 0){
            return response()->json('Data Kosong !!!', 401);
        }
        else{
            return response()->json($data1, 200) ;
        }
    }

  
    public function login(Request $request){


        $data= User::where('email', $request->input('email'))->count();

        if($data == 0){
            return response()->json('Email dan password salah ', 401);
        }
        else{
            // return response()->json('Bagulll', 200);
            $user = User::where('email',$request->input('email'))->first();
            if($user){
                if(Hash::check($request->input('password'),$user->password)){
                    $session_token = Hash::make('rahasia');
                    $user->session_token= $session_token;
                    $user->save();
                    $datauser[] = [
                        "token" => $session_token,
                        "name"  => $user->name,
                        "email" => $user->email,
                    ];

                    $response = [
                        'response' => '200',
                        'message'   => $datauser
                    ];
                    return response()->json($data,200);
                }
                else{
                    return response()->json("gagal",401);
                }
            }
        }
    }

    public function Register(Request $request){

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return response()->json($data,200);

    }
}
