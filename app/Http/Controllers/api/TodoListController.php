<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Todo;
use App\User;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Todo::all();
        return response()->json($data);
        // $user = User::where('id',$request->input('id'))->first();
        // $list = Todo::Where('user_id',$user->id)->get();
        // $data = Todo::Where('user_id',$user->id)->count();
        // if($data == 0){
        //     return response()->json("Data Tidak Ada",401);
        // }
        // else{
        // return response()->json($list,200);
        // }
    }

    public function create(Request $request){

        $user = User::where('id',$request->input('id'))->first();
        $data = $request->all();
        // $data['user_id']=
        $todo = Todo::create($data);
        return response()->json($todo);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
