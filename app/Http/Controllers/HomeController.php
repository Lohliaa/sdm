<?php

namespace App\Http\Controllers;

use App\Exports\HomeExport;
use App\Exports\HomeFilterExport;
use App\Imports\HomeImport;
use App\Models\ArsipSurat;
use App\Models\Carline;
use App\Models\Cost;
use App\Models\Deadline;
use App\Models\Home;
use App\Models\KategoriSurat;
use App\Models\KodeBudget;
use App\Models\MasterBarang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $home = Home::orderBy('id', 'asc')->get();
        $data = $home->all();
        $arsip_surat = ArsipSurat::all();
        $kategori_surat = KategoriSurat::all(); // Ambil semua data kategori_surat
        return view('home', compact('kategori_surat', 'arsip_surat', 'home', 'data'));
    }

    public function searchHome(Request $request)
    {
        $home = $request->input('home');
        
        // Lakukan pencarian berdasarkan input
        $arsip_surat = ArsipSurat::where('kategori', 'LIKE', "%$home%")
                                ->orWhere('nomor_surat', 'LIKE', "%$home%")
                                ->orWhere('judul', 'LIKE', "%$home%")
                                ->get();
    
        // Kembalikan view dengan hasil pencarian
        return view('partialhome', compact('arsip_surat'));
    }    

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }

    public function download($id)
    {
        $arsip_surat = ArsipSurat::findOrFail($id);
        
        // Pastikan file path diambil dari arsip surat
        $filePath = $arsip_surat->file_path;
        
        // Mengatur path lengkap file
        $fullPath = public_path('uploads/' . $filePath);
        
        if (file_exists($fullPath)) {
            return response()->download($fullPath);
        } else {
            abort(404, 'File not found.');
        }
    }  
    
    public function destroy($id)
    {
        // Temukan model berdasarkan ID atau lemparkan pengecualian jika tidak ditemukan
        $arsip_surat = ArsipSurat::findOrFail($id);
    
        // Hapus model
        $arsip_surat->delete();
    
        // Redirect dengan pesan sukses
        return redirect()->route('home')->with('success', 'Data berhasil dihapus');
    }
    
}
