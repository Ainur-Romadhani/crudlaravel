<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
      public function index()
    {
         $user = User::all();
        return view('home' ,compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
        
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()){
            return redirect('home/create')
                            ->withErrors($validator)
                            ->withInput();
        }
       
        if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $ext = $foto->getClientOriginalExtension();
            if($request->file('foto')->isValid()){
                $foto_name = date('YmdHis'). ".$ext";
                $upload_path = 'fotouser';
                $request->file('foto')->move($upload_path, $foto_name);
                $data['foto'] = $foto_name;
            }
        }
        $data['password'] = Hash::make($data['password']);
        
        $user = User::create($data);
        return redirect('home')->with('success',"Data Berhasil Ditambahkan !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
           $user = User::findOrFail($id);
        return view('user.todolist',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $pas = $user->password;

        // if(hash::check('dewi12345',$pas)){

        //     echo "true";
        // }
        // else{
        //     echo "flase";
        // }
        // $password = Crypt::decryptString($pas);
        // dd($password);

        // $hashed = Hash::make('secret');
        // if (Hash::needsRehash($hashed))

        // $hashed = Hash::needsRehash($pas);


        // dd($pas);

        // $end = Crypt::decryptString($pas);
        
        return view('user.edit',compact('user'));
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
        $user = User::findOrFail($id);
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:100|',
            'password' => 'sometimes|nullable|min:8'
        ]);

        if ($validator->fails()){
            return redirect("/home/$id/edit")
                            ->withErrors($validator)
                            ->withInput();
        }
        if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $ext = $foto->getClientOriginalExtension();
            if($request->file('foto')->isValid()){
                $foto_name = date('YmdHis'). ".$ext";
                $upload_path = 'fotouser';
                $request->file('foto')->move($upload_path, $foto_name);
                $data['foto'] = $foto_name;
            }
        }
        $data['password'] = bcrypt($data['password']);
        $user->update($data);
        return redirect('home')->with('success',"Data Berhasil Di Ubah !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('home')->with('delete',"Data Berhasil Dihapus !");
    }
}
