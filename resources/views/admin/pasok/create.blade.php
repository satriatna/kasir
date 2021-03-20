@extends('layouts.template')
@section('content')
<title>Tambah Pasok - Toko Buku</title>

<div class="col-9">
    <div class="container-fluid">

    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="/pasok">Data Pasok</a></li></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Pasok</li>
    </ol>
    </nav>
        <div class="card shadow mb-4">
            <div class="card-header py-3">    
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Penyesuaian Stok</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <form action="/pasok" method="post">
                @csrf
                <table class="table table-striped table-bordered dt-responsive" id="tb">
                <tr>
                <th>Nama Buku</th>
                <th>Jumlah</th>
                <th><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Person"><span class="fas fa-plus"></span></a></th>
                <tr>
                <td>
                <select name="buku_id[]" required class="form-control">
                <option value="" selected>~Pilih Buku~</option>
                    @foreach($buku as $value)
                        <option value="{{$value->id}}">{{$value->judul}}</option>
                    @endforeach
                </select>
                </td>
                <td><input type="number" name="jumlah[]" required class="form-control"></td>
                <td><a href='javascript:void(0);'  class='text-danger remove'><span class='fas fa-trash'></span></a></td>
                
                </tr>
                </table>
                <div class="form-group">
                    <label for="distributor_id">Nama Distributor</label>
                    <select name="distributor_id" id="distributor_id" class="form-control" required>
                        <option value="">~ Pilih Distributor ~</option>
                        @foreach($distributor as $d)
                        <option value="{{$d->id}}">{{$d->namaDist}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                </div>
                <button class="btn btn-primary text-right">Simpan</button>
                </form>
                </div>
            </div>
           
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

    $('#addMore').on('click', function() {
              var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
              data.find("input").val('');
     });
     $(document).on('click', '.remove', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>1) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});      
</script>
@endpush