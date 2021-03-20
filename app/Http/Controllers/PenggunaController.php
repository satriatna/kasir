<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.pengguna.index',compact('users'));
    }
    public function create()
    {
        return view('admin.pengguna.create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'email'=> 'unique:users'
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['role_id'] = 2;
        $data['password'] = bcrypt($request->email);
        User::create($data);
        return redirect('/pengguna')->with('success','Pengguna berhasil ditambahkan');
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.pengguna.edit',compact('user'));
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.pengguna.show',compact('user'));
    }
    public function update(Request $request)
    {
        $this->validate($request,[
            'email'=> 'unique:users,email,'.$request->id
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        if($request->password != null){
            $data['password'] = bcrypt($request->password);
        }

        User::find($request->id)->update($data);
        return redirect('/pengguna')->with('success','Pengguna berhasil diubah');
    }
    public function delete(Request $request,$id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success','Pengguna berhasil dihapus');
    }
    public function reset(Request $request,$id)
    {
        $user = User::find($id);
        User::find($id)->update([
            'password'=>bcrypt($user->email)
        ]);
        return redirect()->back()->with('success','Password pengguna berhasil diubah');
    }
    
}
