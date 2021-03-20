@extends('layouts.template')
@section('content')
<title>Detail Penjualan - Toko distributor</title>
<div class="container-fluid">

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Penjualan</li>
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

<div class="card shadow mb-4">
    
    <div class="card-header">
        <div class="d-flex justify-content-between mt-1">
        <h6 class="font-weight-bold text-primary">Detail Penjualan</h6>
        <a href="/pasok/create" class="fas fa-plus"></a> 
        </div>
    </div>
    <div class="card-header">
        <table>
            <tr>
                <th>Tanggal</th>
                <td> &nbsp; : &nbsp; </td>
                <td>{{$penjualan->tanggal}}</td>
            </tr>
            <tr>
                <th>Total Pembayaran</th>
                <td> &nbsp; : &nbsp; </td>
                <td>@currency($penjualan->totalTagihan)</td>
            </tr>
            <tr>
                <th>Bayar</th>
                <td> &nbsp; : &nbsp; </td>
                <td>@currency($penjualan->bayar)</td>
            </tr>
            <tr>
                <th>Kembalian</th>
                <td> &nbsp; : &nbsp; </td>
                <td>@currency($penjualan->kembalian)</td>
            </tr>
        </table>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Buku</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualanBarang as $key => $barang)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$barang->buku->judul}}</td>
                        <td>{{$barang->jumlah}}</td>
                        <td>@currency($barang->buku->hargaJual)</td>
                        <td>@currency($barang->total)</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-center">Total Penjualan</td>
                        <td>@currency($penjualanBarang->sum('total'))</td>
                    </tr>
                </tbody>
            </table>
            <a href="/penjualan/pdf/{{$penjualan->id}}" class="ml-1 btn btn-primary btn-sm">Cetak Struk</a>
        </div>
    </div>
</div>

</div>
@endsection
<!-- /.container-fluid -->
@push('scripts')
<script>
    
$('.delete-confirm').on('click', function (e) {
    event.preventDefault();
    swal({
        title: 'Apakah Anda Yakin Ingin Menghapus ?',
        text: 'Data akan dihapus secara permanen!',
        icon: 'warning',
        buttons: ["No", "Yes!"],
    }).then(function(value) {
        if (value) {
            $('#distributorDelete').submit();
        }
    });
});
</script>
@endpush