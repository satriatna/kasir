@extends('layouts.template')
@section('content')
<title>Data Pasok - Toko distributor</title>
<div class="container-fluid">

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Pasok</li>
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
        <h6 class="font-weight-bold text-primary">Data Pasok</h6>
        <a href="/pasok/create" class="fas fa-plus"></a> 
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Distributor</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pasoks as $key => $pasok)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$pasok->distributor->namaDist}}</td>
                        <td>{{$pasok->tanggal}}</td>
                        <td>
                            <div class="d-inline d-flex">
                            <a href="/pasok/show/{{$pasok->id}}" class="ml-1 btn btn-success btn-sm">Show</a>
                            <a href="/pasok/pdf/{{$pasok->id}}" class="ml-1 btn btn-primary btn-sm">PDF</a>
                            <form action="/pasok/delete/{{$pasok->id}}" method="POST" id="distributorDelete">
                            @csrf
                            <input type="hidden" name="id" value="{{$pasok->id}}">
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