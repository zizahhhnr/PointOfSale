<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Detail;
use App\Models\Produk;

use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    
    
    public function index(Request $request)
    {
    $search = $request->input('search');

    $details = Detail::with(['produk'])->get();
    
    $query = Penjualan::with('pelanggan', 'details.produk')->orderBy('id_penjualan', 'desc');

    // Jika ada input pencarian, tambahkan kondisi pencarian
    if ($search) {
        $query->where('tgl_penjualan', 'like', '%' . $search . '%')
            ->orWhereHas('pelanggan', function ($q) use ($search) {
                $q->where('nama_pelanggan', 'like', '%' . $search . '%');
            })
            ->orWhereHas('details.produk', function ($q) use ($search) {
                $q->where('nama_produk', 'like', '%' . $search . '%');
            });
    }
    
    // Ambil hasil query dengan pagination
    $penjualans = $query->orderBy('id_penjualan', 'desc')->paginate(10);
    
    // Kirim data ke view
    return view('penjualans.index', compact('penjualans', 'details', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggans = Pelanggan::all(); 
        $produks = Produk::all();
        $details = Detail::with('produk')->get();

        return view('penjualans.create', compact('pelanggans', 'produks', 'details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'id_pelanggan' => 'nullable|exists:pelanggans,id_pelanggan',
        'nama_pembeli' => 'nullable|string|max:255', // Tambahkan ini
        'tgl_penjualan' => 'required|date',
        'total_harga' => 'required|numeric',
        'uang_bayar' => 'required|numeric',
        'kembali' => 'required|numeric',
        'id_detail' => 'required|array|min:1',
        'id_detail.*.id_produk' => 'required|exists:produks,id_produk',
        'id_detail.*.kuantitas' => 'required|integer|min:1',
    ]);
    if (!$request->id_pelanggan && !$request->nama_pembeli) {
        return back()->withErrors(['message' => 'Harap pilih pelanggan atau isi nama pembeli']);
    }
    
    // Cek stok sebelum menyimpan
foreach ($request->id_detail as $detail) {
    $produk = Produk::findOrFail($detail['id_produk']);

    if ($detail['kuantitas'] > $produk->stok) {
        return back()->withErrors([
            'message' => ' Melebihi stok untuk produk ' . $produk->nama_produk . 
            ' (Stok tersedia: ' . $produk->stok . ')'
        ]);
    }
    }

    $penjualan = Penjualan::create($request->only([
        'id_pelanggan',
        'tgl_penjualan',
        'total_harga',
        'uang_bayar',
        'kembali',
    ]));

    foreach ($request->id_detail as $detail) {
        $produk = Produk::findOrFail($detail['id_produk']);

        // Simpan detail penjualan
        Detail::create([
            'id_penjualan' => $penjualan->id_penjualan,
            'id_produk' => $detail['id_produk'],
            'harga' => $detail['harga'] ?? $produk->harga, // Gunakan harga produk jika tidak ada
            'kuantitas' => $detail['kuantitas'],
        ]);

        // Kurangi stok produk
        $produk->stok -= $detail['kuantitas'];
        $produk->save();
    }

    return redirect()->route('penjualans.index')->with('success', 'Penjualan Berhasil Disimpan.');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show($id_penjualan)
    {

    $penjualan = Penjualan::with(['pelanggan', 'details.produk'])->findOrFail($id_penjualan);

    return view('penjualans.show', compact('penjualan'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_penjualan)
    {
        $penjualan = Penjualan::findOrFail($id_penjualan);
        $penjualan->delete();
    
        return redirect()->route('penjualans.index')->with('success', 'Penjualan Berhasil di Hapus.');
    }
}