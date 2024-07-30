<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\User;
use App\Models\Profile;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PengembalianController extends Controller
{
    public function index(){
        $iduser = Auth::id();
        $profile = Profile::where('users_id',$iduser)->first();
        $buku = Buku::where('status','dipinjam')->get();
        $user = User::all();
        $peminjam = Profile::where('users_id','>','1')->get();

        return view('pengembalian.pengembalian',['profile'=>$profile,'users'=>$user,'buku'=>$buku, 'peminjam'=>$peminjam]);
    }

    public function pengembalian(Request $request)
{
    // Validasi input
    $request->validate([
        'users_id' => 'required',
        'buku_id' => 'required'
    ]);

    try {
        DB::beginTransaction();

        // Cari data peminjaman yang sesuai dengan users_id dan buku_id
        $pinjaman = Peminjaman::where('users_id', $request->users_id)
            ->where('buku_id', $request->buku_id)
            ->whereNull('tanggal_pengembalian')
            ->first();

        if ($pinjaman) {
            // Update tanggal_pengembalian
            $pinjaman->tanggal_pengembalian = Carbon::now();
            $pinjaman->save();

            // Update status buku menjadi "In Stock"
            $buku = Buku::findOrFail($request->buku_id);
            $buku->status = 'In Stock'; // Ubah status buku menjadi "In Stock"
            $buku->save();

            DB::commit();
            Alert::success('Berhasil', 'Berhasil Mengembalikan Buku');
            return redirect('/peminjaman');
        } else {
            // Jika tidak ada data peminjaman yang sesuai
            Alert::warning('Gagal', 'Buku yang dipinjam salah atau tidak ada');
            return redirect('/pengembalian');
        }
    } catch (\Throwable $th) {
        DB::rollback();
        // Tangani kesalahan
        Alert::error('Error', 'Gagal mengembalikan buku');
        return redirect('/pengembalian');
    }

    }

}
