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
class LaporanController extends Controller
{
    public function index(Request $request)
    {
        if($request->from_date != null){
            $penjualans = Penjualan::where('tanggal','>=',$request->from_date)
            ->where('tanggal','<=',$request->to_date)->get();
        }else{
            $penjualans = Penjualan::where('status','1')->get();
        }
        return view('admin.laporan.index',compact('penjualans'));
    }
    
    public function pdf($id,$id2)
    {
        $penjualans = Penjualan::where('tanggal','>=',$id)
        ->where('tanggal','<=',$id2)->get();
        $pdf = PDF::loadview('/admin.laporan.pdf',compact('penjualans','id','id2'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    
}
