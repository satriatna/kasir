<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();
        return view('admin.buku.index',compact('bukus'));
    }
    public function create()
    {
        $random = Str::random(5);
        return view('admin.buku.create',compact('random'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'noisbn'=> 'unique:buku'
        ]);
        Buku::create($request->all());
        return redirect('/buku')->with('success','Buku berhasil ditambahkan');
    }
    public function edit($id)
    {
        $buku = Buku::find($id);
        return view('admin.buku.edit',compact('buku'));
    }
    public function show($id)
    {
        $buku = Buku::find($id);
        return view('admin.buku.show',compact('buku'));
    }
    public function update(Request $request)
    {
        $this->validate($request,[
            'noisbn'=> 'unique:buku,noisbn,'.$request->id
        ]);
        Buku::find($request->id)->update($request->all());
        return redirect('/buku')->with('success','Buku berhasil diubah');
    }
    public function delete(Request $request,$id)
    {
        $bukus = Buku::find($id)->delete();
        return redirect()->back()->with('success','Buku berhasil dihapus');
    }
}
