<!DOCTYPE html>
<html>
<head>
<title>Invoice - Toko Buku</title>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
.title th{
  text-align: left;
}
</style>
</head>
<body>
    <center>
        <h1>Invoice Pasok</h1>
    </center>
<table class="title">
    <tr>
        <th>Distributor</th>
        <td>:</td>
        <td>{{$pasok->distributor->namaDist}}</td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <td>:</td>
        <td>{{$pasok->tanggal}}</td>
    </tr>
</table>
<br>
<table id="customers">
    <tr>
        <th>Nama Buku</th>
        <th>Jumlah</th>
    </tr>
    @foreach($pasokBarang as $pasok)
    <tr>
        <td>{{$pasok->buku->judul}}</td>
        <td>{{$pasok->jumlah}}</td>
    </tr>
    @endforeach
</table>

</body>
</html>
