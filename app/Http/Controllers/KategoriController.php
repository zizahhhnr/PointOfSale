<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $query = Kategori::query();
    
          // Jika ada input pencarian, tambahkan kondisi ke query
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('nama_kategori', 'LIKE', '%' . $search . '%')
              ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
        });
    }
    
    // Mendapatkan hasil pencarian
    $results = $query->get();
    
    // Mendapatkan hasil query dengan paginasi
    $kategoris = $query->orderBy('id_kategori', 'desc')->paginate(10);

        // Return ke view dengan data produk
        return view('kategoris.index', compact('kategoris', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategoris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kategori' => 'required|max:255',
            'deskripsi' => 'required',
        ]);
  
        // Membuat record baru di database
        Kategori::create($request->all());
   
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    // public function show(Kategori $kategori)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kategori)
    {
        $kategoris = Kategori::findOrFail($id_kategori); 
        return view('kategoris.edit', compact('kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kategori)
    {
        $this->validate($request, [
            'nama_kategori' => 'required|max:255',
            'deskripsi' => 'required',
          
        ]);
     
        $kategoris = Kategori::findOrFail($id_kategori); 
        $kategoris->update($request->all());

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kategori)
    {
        $kategoris = Kategori::findOrFail($id_kategori); 
        $kategoris->delete();

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
