@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <h2 class="text-yellow"><b>Daftar Buku Yang Belum Dikembalikan</b></h2>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.12.1/date-1.1.2/fc-4.1.0/r-2.3.0/sc-2.0.7/datatables.min.css" />
@endpush

@push('scripts')
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable(); // ID From dataTable
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>
@endpush

@section('content')
    @if (Auth::user()->isAdmin == 1)
    <a href="/peminjaman/create" class="btn btn-warning mb-3 btn-shadow rounded"><b><i class="fa-solid fa-plus"></i> Tambah</b></a>
    <!-- <button class="btn btn-warning mb-3 btn-shadow rounded" data-toggle="modal" data-target="#filterModal"><b><i class="fa-solid fa-print"></i> Cetak</b></button> -->
    @endif

    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/cetaklaporan" method="GET" target="_blank">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Tanggal Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="start_date">Tanggal Awal</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </form>
        </div>
    </div>
    @if (Auth::user()->isAdmin == 1)
</div>
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Kode Buku</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">Tanggal Wajib Pengembalian</th>
                            <th scope="col">Denda</th>
                            <th scope="col">Pengembalian</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @forelse ($peminjam as $item)
                        @if (is_null($item->tanggal_pengembalian))
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->buku->judul }}</td>
                                <td>{{ $item->buku->kode_buku }}</td>
                                <td>{{ $item->tanggal_pinjam }}</td>
                                <td>{{ $item->tanggal_wajib_kembali }}</td>
                                <td>
                                    @php
                                        $tanggalWajibKembali = \Carbon\Carbon::parse($item->tanggal_wajib_kembali);
                                        $tanggalSekarang = \Carbon\Carbon::now();
                                        $hariTerlambat = $tanggalWajibKembali->diffInDays($tanggalSekarang, false);
                                        $denda = $hariTerlambat > 0 ? $hariTerlambat * 3000 : 0;
                                    @endphp
                                    {{ $denda > 0 ? 'Rp. ' . number_format($denda, 0, ',', '.') : '-' }}
                                </td>
                                <td>
                                    <form action="/pengembalian" method="POST">
                                        @csrf
                                        <input type="hidden" name="users_id" value="{{ $item->users_id }}">
                                        <input type="hidden" name="buku_id" value="{{ $item->buku_id }}">
                                        <button type="submit" class="btn btn-success btn-sm">Kembalikan</button>
                                    </form>
                                </td>
                                <td>
                                    @if (!$item->durasi_ditambah)
                                        <button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('tambahDurasi-{{$item->id}}').submit();">Tambah Durasi</button>
                                        <form id="tambahDurasi-{{$item->id}}" action="{{ route('peminjaman.tambahDurasi', $item->id) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Data tidak tersedia</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

    

    @if (Auth::user()->isAdmin == 0)
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Kode Buku</th>
                                <th scope="col">Tanggal Pinjam</th>
                                <th scope="col">Tanggal Wajib Pengembalian</th>
                                <th scope="col">Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                        $no = 1;
                        @endphp
                            @forelse ($peminjam as $item)
                                @if (is_null($item->tanggal_pengembalian))
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->buku->judul }}</td>
                                        <td>{{ $item->buku->kode_buku }}</td>
                                        <td>{{ $item->tanggal_pinjam }}</td>
                                        <td>{{ $item->tanggal_wajib_kembali }}</td>
                                        <td>@php
                                                $tanggalWajibKembali = \Carbon\Carbon::parse($item->tanggal_wajib_kembali);
                                                $tanggalSekarang = \Carbon\Carbon::now();
                                                $hariTerlambat = $tanggalWajibKembali->diffInDays($tanggalSekarang, false);
                                                $denda = $hariTerlambat > 0 ? $hariTerlambat * 3000 : 0;
                                            @endphp
                                            {{ $denda > 0 ? 'Rp. ' . number_format($denda, 0, ',', '.') : '-' }}
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data tidak tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection
