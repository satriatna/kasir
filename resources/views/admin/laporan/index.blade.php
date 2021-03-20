@extends('layouts.template')
@section('content')
<title>Data Laporan - Toko distributor</title>
<div class="container-fluid">

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Laporan</li>
  </ol>
</nav>

<form action="/laporan" method="get">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Dari Tanggal</label>
                @if(request('from_date') != '')
                <input type="date" name="from_date" required class="form-control" value="{{request('from_date')}}" >
                @else
                <input type="date" name="from_date" required class="form-control">
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Sampai Tanggal</label>
                @if(request('to_date') != '')
                <input type="date" name="to_date" required class="form-control" value="{{request('to_date')}}" >
                @else
                <input type="date" name="to_date" required class="form-control">
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label style="color: #F6F8FA !important;">Sampai Tanggal</label> <br>
                <input type="submit" class="btn btn-primary">
                @if(request('to_date') != '')
                <a class="btn btn-warning" href="/laporan/pdf/{{request('from_date')}}/{{request('to_date')}}">Cetak</a>
                @else
                <a class="btn btn-warning" href="/laporan/pdf/{{date('Y-m-d')}}/{{date('Y-m-d')}}">Cetak</a>
                @endif
            </div>
        </div>
    </div>
</form>

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
        <h6 class="font-weight-bold text-primary">Data Laporan</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualans as $key => $penjualan)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$penjualan->tanggal}}</td>
                        <td>
                            <div class="d-inline d-flex">
                            <a href="/penjualan/show/{{$penjualan->id}}" class="ml-1 btn btn-success btn-sm">Show</a>
                            <a href="/penjualan/pdf/{{$penjualan->id}}" class="ml-1 btn btn-primary btn-sm">PDF</a>
                            <form action="/penjualan/delete/{{$penjualan->id}}" method="POST" id="distributorDelete">
                            @csrf
                            <input type="hidden" name="id" value="{{$penjualan->id}}">
                            <button type="submit" class="delete-confirm ml-1 btn btn-danger btn-sm">Delete</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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