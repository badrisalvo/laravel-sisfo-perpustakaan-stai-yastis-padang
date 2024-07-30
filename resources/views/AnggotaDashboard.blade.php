@extends('layouts.master')


@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <h1 class="text-yellow"><b>Dashboard</b></h1>
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
    <div class="row mb-3">
        <!-- Earnings (Monthly) Card Example -->
         
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 bg-gradient-primary">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-uppercase mb-1 text-light">Jumlah Buku</div>
                            <div class="text-sm text-light h5 mb-0 font-weight-bold">{{ $buku }}</div>
                            <div class="button mt-2"><a href="/buku" class="text-light">Lihat</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-book fa-3x text-light"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 bg-gradient-danger">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm text-light font-weight-bold text-uppercase mb-1" style="font-size:.8`rem;">Buku Belum Dikembalikan</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-light">{{ $pinjamanUser }}</div>
                            <div class="button mt-2"><a href="/dipinjam" class="text-light">Lihat</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-3x text-light"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card bg-gradient-secondary">
    <div class="container">
        <h3 class="text-light"> <i class="fa-solid fa-circle-info text-light my-3"></i>  Informasi Aturan Peminjaaman</h3>
        <ol class=text-light>
            <li class=text-light>Waktu peminjaman maksimal 3 Hari</li>
            <li class=text-light>Setiap Mahasiswa hanya dapat meminjam maksimal 2 buku</li>
            <li class=text-light>Jika telah meminjam buku,silahkan ke tempat petugas untuk melakukan konfirmasi</li>
            <li class=text-light>Jika Terlambat mengembalikan buku dan mendapat denda Rp.3.000/hari, maka wajib langsung membayar pada petugas saat mengembalikan buku</li>
        </ol>
    </div>
    </div>
    
@endsection
