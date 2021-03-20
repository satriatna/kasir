@extends('layouts.template')
@section('content')
<title>Detail Distributor - Toko Buku</title>

<div class="col-8">
    <div class="container-fluid">

    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="/distributor">Data Distributor</a></li></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Distributor</li>
    </ol>
    </nav>
    @if($errors->any())
        <div class="alert bg-danger">
            <strong class="text-white"> {{ implode('', $errors->all(':message')) }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">Detail Distributor</h6>
            </div>
            <div class="card-body">
                    <div class="form-group">
                        <label for="namaDist">Nama Distributor</label>
                        <input type="text" class="form-control" name="namaDist" id="namaDist" value="{{$distributor->namaDist}}" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" value="{{$distributor->alamat}}" required>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="number" class="form-control" name="telepon" id="telepon" value="{{$distributor->telepon}}" required>
                    </div>
                    <div class="form-group">
                        <a href="/distributor" class="btn btn-primary">Kembali</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection