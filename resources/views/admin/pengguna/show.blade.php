@extends('layouts.template')
@section('content')
<title>Detail Pengguna - Toko Buku</title>

<div class="col-8">
    <div class="container-fluid">

    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="/pengguna">Data Pengguna</a></li></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Pengguna</li>
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
                <h6 class="font-weight-bold text-primary">Detail Pengguna</h6>
            </div>
            <div class="card-body">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" required>
                    </div>
                    <div class="form-group">
                        <a href="/pengguna" class="btn btn-primary">Kembali</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection