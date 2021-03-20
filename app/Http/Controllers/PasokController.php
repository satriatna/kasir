<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Distributor;
use App\Models\Pasok;
use App\Models\PasokBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PDF;
class PasokController extends Controller
{
    public function index()
    {
        $pasoks = Pasok::all();
        return view('admin.pasok.index',compact('pasoks'));
    }
    public function create()
    {
        $distributor = Distributor::all();
        $buku = Buku::all();
        return view('admin.pasok.create',compact('distributor','buku'));
    }
    public function store(Request $request)
    {
        $ambil = DB::table('buku')->whereIn('id',$request->buku_id)->get();
       
        $buku_id = $request->buku_id;
        $jumlah = $request->jumlah;
        $tipe= $request->tipe;
        $tgl = $request->tanggal;
        foreach($ambil as $key => $value)
        {
            $hitung [] = $value->stock + $request->jumlah[$key];
        }
        
            
        $pasok = DB::table('pasok')->insertGetId([
            'distributor_id'=>$request->distributor_id,
            'tanggal'=>$tgl,
        ]);
    
        foreach($buku_id as $key => $no)
        {
            
            DB::table('pasok_barang')->insert([
                'buku_id'=>$no,
                'jumlah'=>$jumlah[$key],
                'pasok_id'=>$pasok,
            ]);
        
            DB::table('buku')->where('id',$no)->update([
                'stock'=>$hitung[$key]
            ]);
        }
        
        return redirect('/pasok')->with('success','Pasok Berhasil ditambahkan');
    }
    public function show($id)
    {
        $pasok = Pasok::find($id);
        $pasokBarang = PasokBarang::where('pasok_id',$pasok->id)->get();
        return view('admin.pasok.show',compact('pasok','pasokBarang'));
    }
    public function delete(Request $request,$id)
    {
        $pasok = Pasok::find($id)->first();
        PasokBarang::where('pasok_id',$pasok->id)->delete();
        Pasok::find($id)->delete();
        return redirect()->back()->with('success','Pasok Berhasil dihapus');
    }
    
    public function pdf($id)
    {
        $pasok = Pasok::find($id);
        $pasokBarang = PasokBarang::where('pasok_id',$id)->get();
    
        $pdf = PDF::loadview('/admin.pasok.pdf',compact('pasok','pasokBarang'));
        return $pdf->stream();
    }
}
