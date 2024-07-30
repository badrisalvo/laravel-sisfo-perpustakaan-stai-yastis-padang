@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <h2 class="text-yellow"><b>Tambah Buku</b></h2>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush


@section('content')
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-black">Form Tambah Buku</h6>
        </div>
        <div class="card-body">
            <form action="/buku" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="Judul"class="text-black font-weight-bold"> Judul Buku</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}">
                </div>

                @error('judul')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label for="kode_buku"class="text-black font-weight-bold"> Kode Buku</label>
                    <input type="text" name="kode_buku" class="form-control" value="{{ old('kode_buku') }}">
                </div>

                @error('kode_buku')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label for="kategori" class="text-black font-weight-bold">Kategori</label>
                    <select class="form-control" name="kategori_buku[]" id="multiselect" multiple="multiple">
                        @forelse ($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @empty
                            tidak ada kategori
                        @endforelse

                    </select>
                </div>

                @error('kategori')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label for="pengarang" class="text-black font-weight-bold">Pengarang</label>
                    <input type="text" name="pengarang" class="form-control" value="{{ old('pengarang') }}">
                </div>

                @error('pengarang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label for="penerbit" class="text-black font-weight-bold">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit') }}">
                </div>

                @error('penerbit')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label for="tahun_terbit"class="text-black font-weight-bold">Tahun Terbit</label>
                    <input type="text" name="tahun_terbit" value="{{ old('tahun_terbit') }}"class="form-control">
                </div>

                @error('tahun_terbit')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label for="deskripsi"class="text-black font-weight-bold">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="2">{{ old('deskripsi') }}</textarea>
                </div>

                @error('deskripsi')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="d-flex justify-content-end">
                    <a href="/buku" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-primary mx-1 px-4">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('#multiselect').select2({
            allowClear: true
        });
    </script>
@endsection
