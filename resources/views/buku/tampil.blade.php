@extends('layouts.master')

@section('sidebar')
    @include('part.sidebar')
@endsection

@section('topbar')
    @include('part.topbar')
@endsection

@section('judul')
    <h2 class="text-yellow"><b>Daftar Buku</b></h2>
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
        <a href="/buku/create" class="btn btn-warning mb-3 btn-shadow"><b>Tambah Buku</b></a>
    @endif

    <div class="col-lg-auto">
        <div class="card mb-4">
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Kode Buku</th>
                            <th scope="col">Pengarang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Status</th>
                            @if (Auth::user()->isAdmin == 1)
                            <th scope="col">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($buku as $key => $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->kode_buku }}</td>
                                <td>{{ $item->pengarang }}</td>
                                <td>
                                    @foreach ($item->kategori_buku as $kategori)
                                        {{ $kategori->nama }},
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge {{ $item->status == 'In Stock' ? 'badge-success' : ($item->status == 'dipinjam' ? 'badge-danger' : '') }}">
                                        {{ $item->status == 'In Stock' ? 'Tersedia' : 'Dipinjam' }}
                                    </span>
                                </td>
                                @if (Auth::user()->isAdmin == 1)
                                <td>
                                    
                                        <div class="button-area">
                                            <button class="btn-sm btn-info px-2">
                                                <a href="/buku/{{ $item->id }}" style="text-decoration: none; color: white;">Info</a>
                                            </button>
                                            <button class="btn-sm btn-warning px-2">
                                                <a href="/buku/{{ $item->id }}/edit" style="text-decoration: none; color: white;">Edit</a>
                                            </button>
                                            <button class="btn-sm btn-danger px-3">
                                                <a data-toggle="modal" data-target="#DeleteModal{{ $item->id }}">Hapus</a>
                                            </button>
                                        </div>
                                        <div class="modal fade" id="DeleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabelDelete" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ModalLabelDelete">Konfirmasi</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Hapus Data Buku?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
                                                        <form action="/buku/{{ $item->id }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-outline-danger px-4" type="submit" value="delete">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
