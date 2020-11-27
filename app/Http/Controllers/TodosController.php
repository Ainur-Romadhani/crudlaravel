<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Todo;
use DB;
class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $user = User::findOrFail($id);
        $list = Todo::where('user_id',$id)->get();
        return view('todolist.index',compact('user','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::findOrFail($id);
        return view('todolist.createtodo',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['create_by'] = Auth::user()->email;
        $list = Todo::create($data);
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_todos)
    {
        $data = Todo::findOrFail($id_todos);
        return view('todolist.edittodo',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_todos)
    {
        $todo= Todo::findOrFail($id_todos);
        $todo->name = $request->name;
        $todo->start_date = $request->start_date;
        $todo->end_date = $request->end_date;
        $todo->update_by = Auth::user()->email;
        $todo->proggress = $request->proggress;
        $todo->save();
        return redirect('/home');
    }

    public function softdelete($id_todos){

        $todo = Todo::findOrFail($id_todos);
        $todo->delete_by = Auth::user()->email;
        $todo->save();

        $todo->delete();
        return redirect('/home');
    }

    public function tongsampah(){

        $todo = Todo::onlyTrashed()->get();
        return view('todolist.tong',compact('todo'));
    }

    public function restore($id_todos){

        $todo = Todo::onlyTrashed()->where('id_todos',$id_todos);
        $todo->restore();
        return redirect('/home');
    }

    public function restoreall(){

        $todo = Todo::onlyTrashed();
        $todo->restore();
        return redirect('/home');
    }

    public function deletepermanent($id_todos){

        $todo = Todo::onlyTrashed()->where('id_todos',$id_todos);
        $todo->forceDelete();
        return redirect('/home');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteall()
    {
        $todo = Todo::onlyTrashed();
        $todo->forceDelete();
        return redirect('/home');
    }
}
