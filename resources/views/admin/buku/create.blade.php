@extends('layouts.template')
@section('content')
<title>Tambah Barang - Toko Buku</title>

<div class="col-8">
    <div class="container-fluid">

    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="/buku">Data Barang</a></li></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Barang</li>
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
                <h6 class="font-weight-bold text-primary">Tambah Barang</h6>
            </div>
            <div class="card-body">
                <form action="/buku" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul" value="{{old('judul')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="noisbn">No ISBN</label>
                        <input type="text" readonly class="form-control" name="noisbn" id="noisbn" value="{{$random}}" required>
                    </div>
                    <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input type="text" class="form-control" name="penulis" id="penulis" value="{{old('penulis')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit" id="penerbit" value="{{old('penerbit')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="number" class="form-control" name="tahun" id="tahun" value="{{old('tahun')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" name="stock" id="stock" value="{{old('stock')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="hargaPokok">Harga Pokok</label>
                        <input type="number" class="form-control" name="hargaPokok" id="hargaPokok" value="{{old('hargaPokok')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="hargaJual">Harga Jual</label>
                        <input type="number" class="form-control" name="hargaJual" id="hargaJual" value="{{old('hargaJual')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="ppn">PPN (%)</label>
                        <input type="number" class="form-control" name="ppn" id="ppn" value="{{old('ppn')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="disc">Diskon (%)</label>
                        <input type="number" class="form-control" name="disc" id="disc" value="{{old('disc')}}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection