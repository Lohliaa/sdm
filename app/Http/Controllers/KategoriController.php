<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurat;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori_surat = KategoriSurat::orderBy('id', 'asc')->get();
        $data = $kategori_surat->all();
        return view('kategori_surat.index', compact('kategori_surat', 'data'));
    }

    public function searchks(Request $request)
    {
        $kategori_surat = $request->input('kategori_surat');
        
        // Lakukan pencarian berdasarkan input
        $kategori_surat = KategoriSurat::where('nama_kategori', 'LIKE', "%$kategori_surat%")
                                ->orWhere('keterangan', 'LIKE', "%$kategori_surat%")
                                ->get();
    
        // Kembalikan view dengan hasil pencarian
        return view('kategori_surat.partial.kategori_surat', compact('kategori_surat'));
    }  

    public function create()
    {
        return view('kategori_surat.index');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        // Buat kategori baru
        KategoriSurat::create([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
        ]);

        // Redirect kembali ke halaman kategori dengan pesan sukses
        return redirect('kategori_surat')->with('success', 'Kategori baru berhasil ditambahkan.');
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

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required|exists:kategori_surat,id',
            'nama_kategori' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        // Temukan kategori berdasarkan ID
        $kategori = KategoriSurat::findOrFail($request->id);

        // Update kategori
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
        ]);

        // Redirect kembali ke halaman kategori dengan pesan sukses
        return redirect('kategori_surat')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan model berdasarkan ID atau lemparkan pengecualian jika tidak ditemukan
        $kategori_surat = KategoriSurat::findOrFail($id);
    
        // Hapus model
        $kategori_surat->delete();
    
        // Redirect dengan pesan sukses
        return redirect()->route('kategori_surat')->with('success', 'Data berhasil dihapus');
    }
}
