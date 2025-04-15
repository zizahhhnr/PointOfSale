<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $query = Pelanggan::query();
    
        // Jika ada input pencarian, tambahkan kondisi ke query
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('nama_pelanggan', 'LIKE', '%' . $search . '%')
              ->orWhere('alamat', 'LIKE', '%' . $search . '%')
              ->orWhere('no_telp', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%');
        });
    }
    
    // Mendapatkan hasil pencarian
    $results = $query->get();
    
    // Mendapatkan hasil query dengan paginasi
    $pelanggans = $query->orderBy('id_pelanggan', 'desc')->paginate(10);

        // Return ke view dengan data produk
        return view('pelanggans.index', compact('pelanggans', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelanggans.create');
    }


    public function search(Request $request)
    {

    $search = $request->q; // Ambil input pencarian

    $pelanggans = Pelanggan::where('nama_pelanggan', 'LIKE', "%$search%")->get();

    return response()->json($pelanggans);
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
            'nama_pelanggan' => 'required|max:255',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
        ]);
  
        // Membuat record baru di database
        Pelanggan::create($request->all());
   
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    // public function show(Pelanggan $pelanggan)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit($id_pelanggan)
    {
        $pelanggan = Pelanggan::findOrFail($id_pelanggan); 
        return view('pelanggans.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_pelanggan)
    {
        $this->validate($request, [
            'nama_pelanggan' => 'required|max:255',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
        ]);
     
        $pelanggan = Pelanggan::findOrFail($id_pelanggan); 
        $pelanggan->update($request->all());

        return redirect()->route('pelanggans.index')->with('success', 'pelanggan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_pelanggan)
    {
        $pelanggan = Pelanggan::findOrFail($id_pelanggan); 
        $pelanggan->delete();

        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
