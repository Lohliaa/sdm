<?php

namespace App\Http\Controllers;

use App\Exports\HomeExport;
use App\Exports\HomeFilterExport;
use App\Imports\HomeImport;
use App\Models\Home;
use App\Models\MOU;
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
        $mou = MOU::all();
        // $kategori_surat = KategoriSurat::all(); // Ambil semua data kategori_surat
        return view('home', compact('mou', 'home', 'data'));
    }

    // public function searchHome(Request $request)
    // {
    //     $home = $request->input('home');
        
    //     // Lakukan pencarian berdasarkan input
    //     $mou = MOU::where('no_sk', 'LIKE', "%$home%")
    //                             ->orWhere('no_tambahan', 'LIKE', "%$home%")
    //                             ->orWhere('status_kepegawaian', 'LIKE', "%$home%")
    //                             ->orWhere('status_detail', 'LIKE', "%$home%")
    //                             ->orWhere('nama', 'LIKE', "%$home%")
    //                             ->orWhere('gelar', 'LIKE', "%$home%")
    //                             ->orWhere('hari_kerja', 'LIKE', "%$home%")
    //                             ->orWhere('jam_kerja', 'LIKE', "%$home%")
    //                             ->orWhere('alamat', 'LIKE', "%$home%")
    //                             ->orWhere('hari', 'LIKE', "%$home%")
    //                             ->orWhere('tgl_mou', 'LIKE', "%$home%")
    //                             ->orWhere('tempat_lahir', 'LIKE', "%$home%")
    //                             ->orWhere('tanggal_lahir', 'LIKE', "%$home%")
    //                             ->orWhere('unit_kerja', 'LIKE', "%$home%")
    //                             ->orWhere('gaji_pokok', 'LIKE', "%$home%")
    //                             ->orWhere('tunjangan_jabatan', 'LIKE', "%$home%")
    //                             ->orWhere('tunjangan_transport', 'LIKE', "%$home%")
    //                             ->orWhere('tunjangan_kinerja', 'LIKE', "%$home%")
    //                             ->orWhere('tunjangan_fungsional', 'LIKE', "%$home%")
    //                             ->orWhere('thp', 'LIKE', "%$home%")
    //                             ->orWhere('terbilang', 'LIKE', "%$home%")
    //                             ->orWhere('tgl_mulai', 'LIKE', "%$home%")
    //                             ->orWhere('berlaku', 'LIKE', "%$home%")
    //                             ->orWhere('tanggal_akhir', 'LIKE', "%$home%")
    //                             ->orWhere('saksi1', 'LIKE', "%$home%")
    //                             ->orWhere('saksi2', 'LIKE', "%$home%")
    //                             ->get();
    
    //     // Kembalikan view dengan hasil pencarian
    //     return view('mou.partialmou', compact('mou'));
    // }    

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
        $mou = MOU::findOrFail($id);
        
        // Pastikan file path diambil dari arsip surat
        $filePath = $mou->file_path;
        
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
        $mou = MOU::findOrFail($id);
    
        // Hapus model
        $mou->delete();
    
        // Redirect dengan pesan sukses
        return redirect()->route('home')->with('success', 'Data berhasil dihapus');
    }
    
}
