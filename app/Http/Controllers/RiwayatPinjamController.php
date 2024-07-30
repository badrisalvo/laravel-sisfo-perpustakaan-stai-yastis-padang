<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Profile;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RiwayatPinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $iduser = $user->id;
        $profile = Profile::where('users_id', $iduser)->first();
        $denda_perhari = 3000; // Atur nilai denda per hari
    
        if ($user->isAdmin) {
            // Admin sees all data
            $peminjam = Peminjaman::with(['user', 'buku'])->orderBy('updated_at', 'desc')->get();
        } else {
            // Regular users only see their own data
            $peminjam = Peminjaman::with(['user', 'buku'])->where('users_id', $iduser)->orderBy('updated_at', 'desc')->get();
        }
    
        return view('peminjaman.tampil', [
            'profile' => $profile,
            'peminjam' => $peminjam,
            'denda_perhari' => $denda_perhari,
        ]);
    }

    public function dipinjam()
    {
        $user = Auth::user();
        $iduser = $user->id;
        $profile = Profile::where('users_id', $iduser)->first();
        $denda_perhari = 3000; // Atur nilai denda per hari
    
        if ($user->isAdmin) {
            // Admin sees all data
            $peminjam = Peminjaman::with(['user', 'buku'])->orderBy('updated_at', 'desc')->get();
        } else {
            // Regular users only see their own data
            $peminjam = Peminjaman::with(['user', 'buku'])->where('users_id', $iduser)->orderBy('updated_at', 'desc')->get();
        }
    
        return view('peminjaman.dipinjam', [
            'profile' => $profile,
            'peminjam' => $peminjam,
            'denda_perhari' => $denda_perhari,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $iduser = Auth::id();
        $profile = Profile::where('users_id', $iduser)->first();
        $buku = Buku::where('status', 'In Stock')->get();
        $user = User::all();

        if (Auth::user()->isAdmin == 1) {
            $peminjam = Profile::where('users_id', '>', 1)->get();
        } else {
            $peminjam = $profile;
        }

        return view('peminjaman.tambah', [
            'profile' => $profile,
            'users' => $user,
            'buku' => $buku,
            'peminjam' => $peminjam,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'users_id' => 'required',
                'buku_id' => 'required'
            ],
            [
                'users_id.required' => 'Harap Masukan Nama Peminjam',
                'buku_id.required' => 'Masukan Buku yang akan dipinjam'
            ]
        );

        $request['tanggal_pinjam'] = Carbon::now()->toDateString();
        $request['tanggal_wajib_kembali'] = Carbon::now()->addDays(3)->toDateString();

        $buku = Buku::findOrFail($request->buku_id);

        $count = Peminjaman::where('users_id', $request->users_id)->where('tanggal_pengembalian', null)->count();

        if ($count >= 2) {
            Alert::warning('Gagal', 'User telah mencapai limit untuk meminjam buku');
            return redirect('/peminjaman/create');
        } else {
            try {
                DB::beginTransaction();
                // Proses insert tabel peminjaman
                Peminjaman::create($request->all());
                // Proses update tabel buku
                $buku->status = 'dipinjam';
                $buku->save();
                DB::commit();

                Alert::success('Berhasil', 'Berhasil Meminjam Buku');
                return redirect('/peminjaman');
            } catch (\Throwable $th) {
                DB::rollback();
                Alert::error('Gagal', 'Terjadi kesalahan saat meminjam buku');
                return redirect('/peminjaman/create');
            }
        }
    }

    public function tambahDurasi($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->durasi_ditambah) {
            Alert::warning('Gagal', 'Durasi sudah pernah ditambahkan.');
            return redirect()->back();
        }

        $peminjaman->tanggal_wajib_kembali = Carbon::parse($peminjaman->tanggal_wajib_kembali)->addDays(1)->toDateString();
        $peminjaman->durasi_ditambah = true;
        $peminjaman->save();

        Alert::success('Berhasil', 'Durasi berhasil ditambahkan.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
