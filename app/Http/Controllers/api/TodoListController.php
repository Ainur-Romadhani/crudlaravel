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
        // $data1 = Todo::where('user_id', $request->input('user_id'))->get();
        // $data = Todo::where('user_id', $request->input('User_id'))->count();
    
        // if($data == 0){
        //     return response()->json('Data Kosong !!!', 401);
        // }
        // else{
        //     return response()->json($data1, 200) ;
        // }
    }

    public function create(Request $request){

        $todo = Todo::Create([
            'name'          => $request->input('name'),
            'start_date'    => $request->input('start_date'),
            'end_date'      => $request->input('end_date'),
            'proggress'     => $request->input('proggress'),
            'user_id'       => $request->input('user_id'),
            'create_by'     => 'null'
        ]);

        return response()->json($todo,200);
        
    }

  
    public function update(Request $request)
    {
        $todo = Todo::where('id_todos',$request->input('id_todos'))->update([

            'name'          => $request->input('name'),
            'start_date'    => $request->input('start_date'),
            'end_date'      => $request->input('end_date'),
            'proggress'     => $request->input('proggress'),
            'update_by'     => 'null'
        ]);
        return response()->json($todo,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $todo = Todo::where('id_todos',$request->input('id_todos'));
        $todo->update([
            'delete_by' => 'null',
            ]);
            $todo->delete();

        return response()->json("berhasil",200);
    }

    public function tongsampah(Request $request){
        $todo = Todo::onlyTrashed()->where('user_id',$request->input('user_id'))->get();
        $data = Todo::onlyTrashed()->where('user_id',$request->input('user_id'))->count();
        if($data == 0){
            return response()->json("Data tidak di temukan",401);
        }
        else{
            return response()->json($todo,200);
        }
        
    }

    public function todoid(Request $request){
        $todo = Todo::where('user_id',$request->input('user_id'))->get();
        $data = Todo::where('user_id',$request->input('user_id'))->count();

        if($data == 0){
            return response()->json("Data tidak di temukan",401);
        }
        else{
            return response()->json($todo,200);
        }
    }

    public function restore(Request $request){
        $todo = Todo::onlyTrashed()->where('id_todos',$request->input('id_todos'));
        $todo->restore();
        return response()->json("berhasil",200);
    }

    public function deletepermanent(Request $request){
        $todo = Todo::where('id_todos',$request->input('id_todos'));
        $todo->forceDelete();
        return response()->json("data Terhapus Permanent",200);
    }

    public function deleteall(){
        $todo = Todo::onlyTrashed();
        $todo->forceDelete();
        return response()->json("Berhasil !",200);
    }

    public function restoreall(){
        $todo = Todo::onlyTrashed();
        $todo->restore();
        return response()->json("Berhasil restore !!",200);
    }


}
