<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Distributor;
use App\Models\Penjualan;
class DashboardController extends Controller
{
    public function admin()
    {
        $admin = User::where('role_id','1')->count();
        $kasir = User::where('role_id','2')->count();
        $distributor = Distributor::count();
        $barang = Buku::count();

        return view('admin.dashboard.admin',compact('admin','kasir','distributor','barang'));
    }
    public function kasir()
    {
        $barang = Buku::count();
        $transaksi = Penjualan::count();

        return view('admin.dashboard.kasir',compact('barang','transaksi'));
    }
}
