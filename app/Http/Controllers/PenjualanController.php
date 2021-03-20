<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Distributor;
use App\Models\Pasok;
use App\Models\PasokBarang;
use App\Models\Penjualan;
use App\Models\PenjualanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Auth;
class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::where('status','1')->get();
        return view('admin.penjualan.index',compact('penjualans'));
    }
    public function create()
    {
        $bukus = Buku::where('stock','>','0')->get();
        $penjualanBarang = PenjualanBarang::where('status','0')->get();
        return view('admin.penjualan.create',compact('bukus','penjualanBarang'));
    }
    public function store(Request $request)
    {
        $ambil = Buku::find($request->buku_id);
        $total = $ambil->hargaJual * $request->jumlah;
        $data['buku_id'] = $request->buku_id;
        $data['jumlah'] = $request->jumlah;
        $data['total'] = $total;
        PenjualanBarang::create($data);
        return redirect('/penjualan/create')->with('success','Penjualan Berhasil ditambahkan');
    }
    public function bayar(Request $request)
    {
        if($request->kembalian < 0){
            return redirect()->back()->with('fail', "bayaran Anda kurang");
        }
        $totalTagihan = PenjualanBarang::where('status', 0)->sum('total');

        $penjualanId = DB::table('penjualan')->insertGetId([
            'user_id'=>Auth::user()->id,
            'tanggal'=>date('Y-m-d'),
            'bayar'=>$request->bayar,
            'kembalian'=>$request->kembalian,
            'totalTagihan'=>$totalTagihan,
            'status'=>'1',
        ]);
        $data['penjualan_id'] = $penjualanId;
        $data['status'] = 1;

        $off = PenjualanBarang::where('status', 0)->get();
        foreach($off as $of)
        {
            $buku = Buku::find($of->buku_id);
            $stock = $buku->stock - $of->jumlah;
            DB::table('buku')->where("id",$of->buku_id)->update([
                'stock'=>$stock
            ]);
        }
        PenjualanBarang::where('status', 0)->update($data);
        return redirect()->back()->with('success', "Pembayaran berhasil");

    }
    public function show($id)
    {
        $penjualan = Penjualan::find($id);
        $penjualanBarang = PenjualanBarang::where('penjualan_id',$penjualan->id)->get();
        return view('admin.penjualan.show',compact('penjualan','penjualanBarang'));
    }
    public function delete(Request $request,$id)
    {
        $penjualan = Penjualan::find($id)->first();
        PenjualanBarang::where('penjualan_id',$penjualan->id)->delete();
        Penjualan::find($id)->delete();
        return redirect()->back()->with('success','Penjualan Berhasil dihapus');
    }
    
    public function pdf($id)
    {
        $penjualan = Penjualan::find($id);
        $penjualanBarang = PenjualanBarang::where('penjualan_id',$id)->get();
        $pdf = PDF::loadview('/admin.penjualan.pdf',compact('penjualan','penjualanBarang'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    
    public function ambilHarga(Request $request)
    {
            
        $city = DB::table("buku")
        ->where("id",$request->id)
        ->pluck("stock","hargaJual");
        return response()->json($city);
    }
}
