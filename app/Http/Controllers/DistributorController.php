<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();
        return view('admin.distributor.index',compact('distributors'));
    }
    public function create()
    {
        return view('admin.distributor.create');
    }
    public function store(Request $request)
    {
        Distributor::create($request->all());
        return redirect('/distributor')->with('success','Distributor berhasil ditambahkan');
    }
    public function edit($id)
    {
        $distributor = Distributor::find($id);
        return view('admin.distributor.edit',compact('distributor'));
    }
    public function show($id)
    {
        $distributor = Distributor::find($id);
        return view('admin.distributor.show',compact('distributor'));
    }
    public function update(Request $request)
    {
        Distributor::find($request->id)->update($request->all());
        return redirect('/distributor')->with('success','Distributor berhasil diubah');
    }
    public function delete(Request $request,$id)
    {
        $distributors = Distributor::find($id)->delete();
        return redirect()->back()->with('success','Distributor berhasil dihapus');
    }
}
