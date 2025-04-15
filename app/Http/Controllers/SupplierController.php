<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $query = Supplier::query();
    
           // Jika ada input pencarian, tambahkan kondisi ke query
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('nama_supplier', 'LIKE', '%' . $search . '%')
              ->orWhere('no_telp', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%')
              ->orWhere('kontak_person', 'LIKE', '%' . $search . '%');
        });
    }
    
    // Mendapatkan hasil pencarian
    $results = $query->get();
    
    // Mendapatkan hasil query dengan paginasi
    $suppliers = $query->orderBy('id_supplier', 'desc')->paginate(10);

    
        // Return ke view dengan data produk
        return view('suppliers.index', compact('suppliers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
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
            'nama_supplier' => 'required|max:255',
            'no_telp' => 'required',
            'email' => 'required',
            'kontak_person' => 'required',
        ]);
  
        // Membuat record baru di database
        Supplier::create($request->all());
   
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    // public function show(Supplier $supplier)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id_supplier)
    {
        $suppliers = Supplier::findOrFail($id_supplier); 
        return view('suppliers.edit', compact('suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_supplier)
    {
        $this->validate($request, [
            'nama_supplier' => 'required|max:255',
            'no_telp' => 'required',
            'email' => 'required',
            'kontak_person' => 'required',
        ]);
     
        $suppliers = Supplier::findOrFail($id_supplier); 
        $suppliers->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_supplier)
    {
        $suppliers = Supplier::findOrFail($id_supplier); 
        $suppliers->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
