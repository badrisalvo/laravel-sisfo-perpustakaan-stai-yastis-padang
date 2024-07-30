<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class CetakLaporanController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $riwayat_peminjaman = Peminjaman::with('user', 'buku')
            ->whereBetween('tanggal_pinjam', [$startDate, $endDate])
            ->get();

        $pdf = PDF::loadView('peminjaman.laporan_pdf', [
            'riwayat_peminjaman' => $riwayat_peminjaman,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);

        return $pdf->download('laporan_peminjaman.pdf');
    }
}
