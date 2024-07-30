<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISFO Perpustakaan STAI Yastis Padang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: -20px;
        }
        table tr td,
        table tr th {
            font-size: 8pt;
            padding: 8px;
            border: 1px solid #000;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        @page {
            size: A4 landscape; /* Ubah orientasi halaman menjadi lanskap */
            margin: 10mm;
        }
        .signature .name {
            margin-top: 80px;
            font-weight: bold;
            text-decoration: underline;
            margin-right: 50px;
        }
        .img {
            height: 80px;
            width: 85px;
            margin-right: 10px;
            vertical-align: middle;
            position: absolute;
            top: -28px; 
            left: 100px; 
            filter: grayscale(100%);
        }
        header {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative; /* Menambahkan posisi relatif untuk header */
        }
        .title {
            text-align: center;
            margin-top: -30px;
        }
    </style>
</head>
<body>
<header>
<div class="title">
    <img src="https://images2.imgbox.com/ae/5e/dk1O6JHM_o.png" class="img" alt="Logo">
    
        <h3><u>SISFO Perpustakaan STAI Yastis Padang</u></h3>
        <h5>Laporan Peminjaman dan Pengembalian {{ \Carbon\Carbon::parse($startDate)->isoFormat('D MMMM YYYY') }} - {{ \Carbon\Carbon::parse($endDate)->isoFormat('D MMMM YYYY') }}</h5>
    </div>
</header>

<table class='table table-bordered mt-3'>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NPM</th>
            <th>Judul Buku</th>
            <th>Kode Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Wajib<br>Pengembalian</th>
            <th>Tanggal<br>Pengembalian</th>
            <th>Denda</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalDenda = 0;
        @endphp
        @forelse ($riwayat_peminjaman as $item)
            @if (!is_null($item->tanggal_pengembalian))
                @php
                    $tanggalWajibKembali = \Carbon\Carbon::parse($item->tanggal_wajib_kembali);
                    $tanggalPengembalian = \Carbon\Carbon::parse($item->tanggal_pengembalian);
                    $hariTerlambat = $tanggalWajibKembali->diffInDays($tanggalPengembalian, false);
                    $denda = $hariTerlambat > 0 ? $hariTerlambat * 3000 : 0;
                    $totalDenda += $denda;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->user->profile->npm }}</td>
                    <td>{{ $item->buku->judul }}</td>
                    <td>{{ $item->buku->kode_buku }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_wajib_kembali }}</td>
                    <td>{{ $item->tanggal_pengembalian }}</td>
                    <td>{{ $denda > 0 ? 'Rp. ' . number_format($denda, 0, ',', '.') : '-' }}</td>
                </tr>
            @endif
        @empty
            <tr>
                <td colspan="9" class="text-center">Data tidak tersedia</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="8" class="text-right font-weight-bold">Total Denda</td>
            <td>{{ 'Rp. ' . number_format($totalDenda, 0, ',', '.') }}</td>
        </tr>
    </tfoot>
</table>

<div class="signature">
<p>{{ \Carbon\Carbon::now()->locale('id')->formatLocalized('Padang, %d %B %Y') }}</p>
    <p class="name">{{Auth::user()->name}}</p>
</div>

</body>
</html>
