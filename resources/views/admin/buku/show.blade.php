@extends('layouts.template')
@section('content')
<title>Detail Barang - Toko Buku</title>

<div class="col-8">
    <div class="container-fluid">

    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="/buku">Data Barang</a></li></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Barang</li>
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
                <h6 class="font-weight-bold text-primary">Detail Barang</h6>
            </div>
            <div class="card-body">
                    <input type="hidden" name="id" value="{{$buku->id}}">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul" value="{{$buku->judul}}" required>
                    </div>
                    <div class="form-group">
                        <label for="noisbn">No ISBN</label>
                        <input type="text" readonly class="form-control" name="noisbn" id="noisbn" value="{{$buku->noisbn}}" required>
                    </div>
                    <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input type="text" class="form-control" name="penulis" id="penulis" value="{{$buku->penulis}}" required>
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit" id="penerbit" value="{{$buku->penerbit}}" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="number" class="form-control" name="tahun" id="tahun" value="{{$buku->tahun}}" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" name="stock" id="stock" value="{{$buku->stock}}" required>
                    </div>
                    <div class="form-group">
                        <label for="hargaPokok">Harga Pokok</label>
                        <input type="number" class="form-control" name="hargaPokok" id="hargaPokok" value="{{$buku->hargaPokok}}" required>
                    </div>
                    <div class="form-group">
                        <label for="hargaJual">Harga Jual</label>
                        <input type="number" class="form-control" name="hargaJual" id="hargaJual" value="{{$buku->hargaJual}}" required>
                    </div>
                    <div class="form-group">
                        <label for="ppn">PPN (%)</label>
                        <input type="number" class="form-control" name="ppn" id="ppn" value="{{$buku->ppn}}" required>
                    </div>
                    <div class="form-group">
                        <label for="disc">Diskon (%)</label>
                        <input type="number" class="form-control" name="disc" id="disc" value="{{$buku->disc}}" required>
                    </div>
                    <div class="form-group">
                        <a href="/buku" class="btn btn-primary">Kembali</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection