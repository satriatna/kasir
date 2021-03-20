@extends('layouts.template')
@section('content')
<title>Tambah Penjualan - Toko Buku</title>

<div class="col-12">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="/penjualan">Data Penjualan</a></li></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Penjualan</li>
            </ol>
        </nav>
        @if(Session::get('success'))
            <div class="alert bg-success">
                <strong class="text-white"> {{Session::get('success')}} </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(Session::get('fail'))
            <div class="alert bg-danger">
                <strong class="text-white"> {{Session::get('fail')}} </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                Masukkan Transaksi
            </div>
            <div class="card-body">
                <form action="/penjualan" method="post">
                @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="buku_id">Nama Buku</label>
                                <select name="buku_id" id="buku_id" class="form-control" required>
                                    <option value="">~ Pilih Buku ~ </option>
                                    @foreach($bukus as $buku)
                                    <option value="{{$buku->id}}">{{$buku->judul}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="hargaJual">Harga</label>
                                <input type="text" name="hargaJual" value="" id="hargaJual" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" name="jumlah" disabled id="jumlah" class="form-control" required>
                            </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card mt-2">
                <div class="card-header">
                    Data Transaksi
                </div>
                    <div class="card-body">
                       <table class="table">
                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualanBarang as $barang)
                                <tr>
                                    <td>{{$barang->buku->judul}}</td>
                                    <td>{{$barang->jumlah}}</td>
                                    <td>{{$barang->buku->hargaJual}}</td>
                                    <td>
                                        {{$barang->total}}
                                        <input type="hidden" id="total" value="{{$penjualanBarang->sum('total')}}">
                                    </td>
                                </tr>
                                @endforeach
                                @if($penjualanBarang->count() == 0)
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="3"> Total</td>
                                    <td> {{$penjualanBarang->sum('total')}} </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            @if($penjualanBarang->count() == 0)
            @else
            <div class="col-4">
                <div class="card mt-2">
                    <div class="card-header">
                        Pembayaran
                    </div>
                    <form action="/penjualan/bayar" method="post">
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="bayar">Bayar</label>
                                <input type="number" name="bayar" onkeyup="hitung()" id="bayar" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="kembalian">Kembalian</label>
                                <input type="number" name="kembalian" id="kembalian" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Bayar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
$(function(){
    
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});


$('#buku_id').change(function(){
    $("#jumlah").prop("disabled", false);
    var buku_id = $(this).val();    
    if(buku_id){
        $.ajax({
           type:"GET",
           url:"{{url('penjualan/ambilHarga')}}?id="+buku_id,
           success:function(res){               
            if(res){
                $.each(res,function(key,stok){
                    $("#hargaJual").val(key);
                });
           
            }else{
                $("#hargaJual").empty();
            }
           }
        });
    }else{
        $("#hargaJual").empty();
    }      
});

});
function hitung()
{
    var bayar = $('#bayar').val();
    var kembalian = $('#kembalian').val();
    var total = $('#total').val();
    if(bayar == null){
        kembalian.empty()
    }else{
        var a = parseInt(bayar) - parseInt(total);
        $('#kembalian').val(a);
    }
}
</script>
@endpush