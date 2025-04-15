<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $query = Produk::with('kategori', 'supplier');
    
        // Jika ada pencarian, tambahkan filter ke query
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->Where('nama_produk', 'LIKE', '%' . $search . '%') // Pencarian di tabel kondisi_alats
            ->orWhere('harga', 'LIKE', '%' . $search . '%')
            ->orWhere('stok', 'LIKE', '%' . $search . '%');
            
        })
        ->orWhereHas('kategori', function($q) use ($search) {
            $q->where('nama_kategori', 'LIKE', '%' . $search . '%'); // Pencarian di tabel alats
        })

        ->orWhereHas('supplier', function($q) use ($search) {
            $q->where('nama_supplier', 'LIKE', '%' . $search . '%'); // Pencarian di tabel alats
        });
    }
    
        $produks = $query->orderBy('id_produk', 'desc')->paginate(10);
    
        // Return ke view dengan data produk
        return view('produks.index', compact('produks', 'search'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $kategoris = Kategori::all(); // Pastikan 'Kategori' adalah model yang benar
        return view('produks.create', compact('kategoris', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    // Validasi data input
    $this->validate($request, [
        // 'no_invoice' => 'required|unique:produks,no_invoice',
        'nama_produk' => 'required|max:255',
        'id_kategori' => 'required|exists:kategoris,id_kategori',
        'id_supplier' => 'required|exists:suppliers,id_supplier',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
    ]);

     // Ambil ID terakhir untuk mencegah duplikasi
     $lastProduk = Produk::latest()->first();
     $nextId = $lastProduk ? $lastProduk->id_produk + 1 : 1;
 
     // Format nomor invoice lebih pendek
     $noInvoice = 'INV-' . date('ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

    
    // Simpan data ke database
    Produk::create([
        'no_invoice' => $noInvoice, // Menggunakan invoice otomatis
        'nama_produk' => $request->nama_produk,
        'id_kategori' => $request->id_kategori,
        'id_supplier' => $request->id_supplier,
        'harga' => $request->harga,
        'stok' => $request->stok,
    ]);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    // public function show(Produk $produk)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id_produk)
    {
        $produk = Produk::findOrFail($id_produk);
        $kategoris = Kategori::all(); // Fetch the list of categories
        $suppliers = Supplier::all();
        return view('produks.edit', compact('produk', 'kategoris', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_produk)
    {
        
        $this->validate($request, [
            // 'no_invoice' => 'required',
            'nama_produk' => 'required|max:255',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'id_supplier' => 'required|exists:suppliers,id_supplier',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);
     
        $produk = Produk::findOrFail($id_produk); 
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'id_kategori' => $request->id_kategori,
            'id_supplier' => $request->id_supplier,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
        
        return redirect()->route('produks.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_produk)
    {
        $produk = Produk::findOrFail($id_produk); 
        $produk->delete();

        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus.');
    }
}
