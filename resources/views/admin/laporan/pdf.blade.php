<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:18px;
            margin:0;
        }
        .container{
            margin:0 auto;
            margin-top:1px;
            padding:40px;
            width:750px;
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:28px;
            margin-bottom:15px;
        }
        table{
            border:1px solid #333;
            border-collapse:collapse;
            margin:0 auto;
            width:740px;
        }
        td, tr, th{
            padding:12px;
            border:1px solid #333;
            width:185px;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
        }
    </style>
</head>
<body>
@foreach($penjualans as $p)
    <div class="container mt-1">
        <table>
            <caption>
                Laporan Transaksi
            <thead>
                <tr>
                    <th>Dari Tanggal</strong></th>
                    <th>{{ $id }}</th>
                    <th>Sampai Tanggal</strong></th>
                    <th>{{ $id2 }}</th>
                </tr>
            </thead>
            </caption>
            <thead>
                <tr>
                    <th colspan="3">Tanggal</strong></th>
                    <th>{{ $p->tanggal }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <th>Buku</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Total Harga</th>
                </tr>
                @php
                    $penjualanBarang = App\Models\PenjualanBarang::where('penjualan_id',$p->id)->get();
                @endphp
                @foreach ($penjualanBarang as $barang)
                <tr>
                  <td>{{$barang->buku->judul}}</td>
                  <td>{{$barang->jumlah}}</td>
                  <td>@currency($barang->buku->hargaJual)</td>
                  <td>@currency($barang->total)</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="3">Total</th>
                    <td>@currency($penjualanBarang->sum('total'))</td>
                </tr>
            </tbody>
        </table>
    </div>
@endforeach
</body>
</html>