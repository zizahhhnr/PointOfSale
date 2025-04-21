<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
{
    $bulan = $request->bulan;
    $tahun = $request->tahun;

    $query = Penjualan::with(['details.produk'])
        ->orderBy('created_at', 'desc'); // Urutkan berdasarkan waktu terbaru

    if ($bulan) {
        $query->whereMonth('tgl_penjualan', $bulan);
    }

    if ($tahun) {
        $query->whereYear('tgl_penjualan', $tahun);
    }

    $penjualans = $query->get();

    return view('laporan.penjualan', compact('penjualans', 'bulan', 'tahun'));
}



    public function cetakPDF(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = Penjualan::with(['details.produk'])->orderBy('created_at', 'desc');

        if ($bulan) {
            $query->whereMonth('tgl_penjualan', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tgl_penjualan', $tahun);
        }

        $penjualans = $query->get();

        $pdf = Pdf::loadView('laporan.penjualan_pdf', compact('penjualans', 'bulan', 'tahun'));
        return $pdf->download('laporan_penjualan.pdf');
    }
}


