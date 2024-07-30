<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        <div class="sidebar-brand-icon ">
            <img src="{{ asset('img/logo.png') }}">
        </div>
        <div class="text-yellow ">STAI Yastis Padang</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="/home">
            <i class="fa-solid fa-house"></i>
            <span><b>Home</b></span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features

    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="fa-solid fa-book"></i>
            <span><b>Buku</b></span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Buku</h6>
                <a class="collapse-item" href="/buku">Lihat Semua Buku</a>

                @if (Auth::user()->isAdmin == 1)
                    <a class="collapse-item" href="/buku/create">Tambah Buku</a>
                @endif

            </div>
        </div>
    </li>
    @if (Auth::user()->isAdmin == 1)
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm"
            aria-expanded="true" aria-controls="collapseForm">
            <i class="fa-solid fa-book-open"></i>
            <span><b>Kategori</b></span>
        </a>
        <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kategori</h6>
                <a class="collapse-item" href="/kategori">Lihat Kategori</a>
                    <a class="collapse-item" href="/kategori/create">Tambah Kategori</a>
            </div>
        </div>
    </li>
    @endif
    @if (Auth::user()->isAdmin == 1)
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable"
                aria-expanded="true" aria-controls="collapseTable">
                <i class="fa-solid fa-users"></i>
                <span><b>Daftar Mahasiswa</b></span>
            </a>
            <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data</h6>
                    <a class="collapse-item" href="/anggota">Tampilkan Data Mahasiswa</a>
                    <a class="collapse-item" href="/anggota/create">Tambah Data Mahasiswa</a>
                </div>
            </div>
        </li>
    @endif

    @if (Auth::user()->isAdmin == 1)
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePeminjam"
                aria-expanded="true" aria-controls="collapsePeminjam">
                <i class="fa-solid fa-user-pen"></i>
                <span><b>Peminjaman</b></span>
            </a>
            <div id="collapsePeminjam" class="collapse" aria-labelledby="headingPeminjam"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Peminjaman</h6>
                    <a class="collapse-item" href="/peminjaman">Daftar Riwayat Peminjaman</a>
                    <a class="collapse-item" href="/dipinjam">Daftar Buku Dipinjam</a>
                    <a class="collapse-item" href="/peminjaman/create">Tambahkan Peminjaman</a>
                </div>
            </div>
        </li>
        @endif
    @if (Auth::user()->isAdmin == 0)
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePeminjam"
                aria-expanded="true" aria-controls="collapsePeminjam">
                <i class="fas fa-fw fa-table"></i>
                <span><b>Peminjaman</b></span>
            </a>
            <div id="collapsePeminjam" class="collapse" aria-labelledby="headingPeminjam"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pinjam Buku</h6>
                    <a class="collapse-item" href="/peminjaman/create">Pinjam Buku Baru</a>
                    <a class="collapse-item" href="/peminjaman">Riwayat Pinjaman Selesai</a>
                    <a class="collapse-item" href="/dipinjam">Daftar Buku Belum Dikembalikan</a>
                </div>
            </div>
        </li>
    @endif
</ul>
