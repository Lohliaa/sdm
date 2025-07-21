<?php

namespace App\Http\Controllers;

use App\Models\ArsipSurat;
use App\Models\Home;
use App\Models\KategoriSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
use setasign\Fpdi\Tcpdf\Fpdi;

class ArsipController extends Controller
{

    public function index()
    {
        $arsip_surat = ArsipSurat::orderBy('id', 'asc')->get();
        $data = $arsip_surat->all();
        $kategori_surat = KategoriSurat::all(); // Ambil semua data kategori_surat
        return view('arsip_surat.index', compact('kategori_surat', 'arsip_surat', 'data'));
    }

    public function create()
    {
        // Ambil data kategori dari model
        $kategori_surat = KategoriSurat::all(); // Sesuaikan dengan model Anda

        // Kembalikan tampilan dengan data kategori
        return view('arsip_surat.index', compact('kategori_surat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomorSurat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'fileUpload' => 'required|file|mimes:pdf|max:2048',
        ]);

        $arsipSurat = new ArsipSurat();
        $arsipSurat->nomor_surat = $request->input('nomorSurat');
        $arsipSurat->kategori = $request->input('kategori');
        $arsipSurat->judul = $request->input('judul');

        if ($request->hasFile('fileUpload')) {
            $file = $request->file('fileUpload');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $arsipSurat->file_path = 'uploads/' . $filename;
        }
        if ($arsipSurat->save()) {
            return redirect()->route('arsip_surat.create')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->route('arsip_surat.create')->with('error', 'Gagal menyimpan data!');
        }
    }
    
    public function download($id)
    {
        $arsipSurat = ArsipSurat::findOrFail($id);
        $filePath = public_path($arsipSurat->file_path);
    
        // Buat PDF dengan informasi tambahan
        $pdfData = PDF::loadView('arsip_surat.pdf', ['arsipSurat' => $arsipSurat]);
    
        // Simpan PDF tambahan ke dalam folder storage
        $additionalPdfPath = storage_path('app/public/additional_info_' . $arsipSurat->id . '.pdf');
        $pdfData->save($additionalPdfPath);
    
        // Buat objek FPDI untuk menggabungkan kedua file PDF
        $fpdi = new Fpdi();
        $outputPath = storage_path('app/public/arsip_surat_' . $arsipSurat->id . '.pdf');
    
        // Tambahkan halaman dari PDF tambahan
        $pageCount = $fpdi->setSourceFile($additionalPdfPath);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $tplId = $fpdi->importPage($pageNo);
            $fpdi->AddPage();
            $fpdi->useTemplate($tplId);
        }
    
        // Tambahkan halaman dari PDF asli
        $pageCount = $fpdi->setSourceFile($filePath);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $tplId = $fpdi->importPage($pageNo);
            $fpdi->AddPage();
            $fpdi->useTemplate($tplId);
        }
    
        // Simpan PDF gabungan
        $fpdi->Output($outputPath, 'F');
    
        // Hapus PDF tambahan setelah digabungkan
        unlink($additionalPdfPath);
    
        // Return response untuk mengunduh file PDF
        return response()->download($outputPath)->deleteFileAfterSend(true);
    } 

    public function show($id)
    {
        $arsip_surat = ArsipSurat::findOrFail($id);
        $filePath = $arsip_surat->file_path;

        // Pastikan file path benar dan file ada di lokasi tersebut
        $fullPath = storage_path('app/public/uploads/' . $filePath);

        if (file_exists($fullPath)) {
            // Menampilkan file PDF
            return response()->file($fullPath);
        } else {
            // Tangani kasus file tidak ditemukan
            return response()->json(['error' => 'File not found'], 404);
        }
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required|exists:arsip_surat,id',
            'nomor_surat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf|max:2048', // Validasi file
        ]);

        // Temukan arsip surat berdasarkan ID
        $arsip_surat = ArsipSurat::findOrFail($request->id);

        // Jika ada file yang diunggah
        if ($request->hasFile('file_path')) {
            // Hapus file lama jika ada
            if ($arsip_surat->file_path && Storage::exists($arsip_surat->file_path)) {
                Storage::delete($arsip_surat->file_path);
            }

            // Simpan file baru
            $file = $request->file('file_path');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $filePath = 'uploads/' . $filename;
        } else {
            // Gunakan file path lama jika tidak ada file yang diunggah
            $filePath = $arsip_surat->file_path;
        }

        // Update arsip surat
        $arsip_surat->update([
            'nomor_surat' => $request->nomor_surat,
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'file_path' => $filePath,
        ]);

        // Redirect kembali ke halaman arsip surat dengan pesan sukses
        return redirect('home')->with('success', 'Arsip surat berhasil diperbarui.');
    }


    public function destroy($id)
    {
        //
    }
}
