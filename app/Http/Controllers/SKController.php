<?php

namespace App\Http\Controllers;

use App\Exports\SKExport;
use App\Helpers\DateHelper;
use App\Imports\SKImport;
use App\Models\SK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use setasign\Fpdi\Tcpdf\Fpdi;

class SKController extends Controller
{

    public function index()
    {
        $sk = SK::orderBy('id', 'asc')->paginate(10);
        $data = $sk->all();

        $fields = ['tanggal_lahir', 'tanggal_mulai', 'tanggal_akhir', 'tanggal_ditetapkan'];

        foreach ($data as $item) {
            foreach ($fields as $field) {
                $item->{$field} = DateHelper::formatFlexible($item->{$field});
            }
        }


        return view('sk.index', compact('sk', 'data'));
    }

    public function searchSK(Request $request)
    {
        $sk = $request->input('sk');

        // Lakukan pencarian berdasarkan input
        $sk = SK::where('no_sk', 'LIKE', "%$sk%")
            ->orWhere('no_tambahan', 'LIKE', "%$sk%")
            ->orWhere('nama', 'LIKE', "%$sk%")
            ->orWhere('gelar', 'LIKE', "%$sk%")
            ->orWhere('tempat_lahir', 'LIKE', "%$sk%")
            ->orWhere('tanggal_lahir', 'LIKE', "%$sk%")
            ->orWhere('nipy', 'LIKE', "%$sk%")
            ->orWhere('gol_ruang', 'LIKE', "%$sk%")
            ->orWhere('status_kepegawaian', 'LIKE', "%$sk%")
            ->orWhere('unit_kerja', 'LIKE', "%$sk%")
            ->orWhere('tmt', 'LIKE', "%$sk%")
            ->orWhere('tanggal_mulai', 'LIKE', "%$sk%")
            ->orWhere('berlaku', 'LIKE', "%$sk%")
            ->orWhere('tanggal_akhir', 'LIKE', "%$sk%")
            ->orWhere('tanggal_ditetapkan', 'LIKE', "%$sk%")
            ->get();

        // Kembalikan view dengan hasil pencarian
        return response()->view('sk.partialsk', compact('sk'));
    }

    public function create()
    {
        return view('sk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_sk' => 'required',
            'no_tambahan' => 'required',
            'nama' => 'required',
            'gelar' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nipy' => 'required',
            'gol_ruang' => 'required',
            'status_kepegawaian' => 'required',
            'unit_kerja' => 'required',
            'tmt' => 'required',
            'tanggal_mulai' => 'required',
            'berlaku' => 'required',
            'tanggal_akhir' => 'required',
            'tanggal_ditetapkan' => 'required',
        ]);

        $sk = SK::create([
            'no_sk' => $request->no_sk,
            'no_tambahan' => $request->no_tambahan,
            'nama' => $request->nama,
            'gelar' => $request->gelar,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nipy' => $request->nipy,
            'gol_ruang' => $request->gol_ruang,
            'status_kepegawaian' => $request->status_kepegawaian,
            'unit_kerja' => $request->unit_kerja,
            'tmt' => $request->tmt,
            'tanggal_mulai' => $request->tanggal_mulai,
            'berlaku' => $request->berlaku,
            'tanggal_akhir' => $request->tanggal_akhir,
            'tanggal_ditetapkan' => $request->tanggal_ditetapkan,

        ]);
        return redirect()->route('sk.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function export()
    {
        return Excel::download(new SKExport, 'Data SK Gupeg SIT Permata.xlsx');
    }

    public function upload()
    {
        return view('sk.index'); // Buat view ini nanti
    }

    public function uploadProcess(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv', // Sesuaikan dengan kebutuhan
        ]);

        // Contoh: menyimpan file upload ke storage
        $path = $request->file('file')->store('uploads');

        // Jika menggunakan Laravel Excel (opsional)
        Excel::import(new SKImport, $request->file('file'));

        return redirect()->route('sk.index')->with('success', 'Data berhasil diupload.');
    }

    public function edit($id)
    {
        $sk = SK::findOrFail($id);
        return view('sk.edit', compact('sk'));
    }

    public function update(Request $request, $id)
    {
        $sk = SK::findOrFail($id);

        // Validasi dan update data
        $sk->update($request->all());

        return redirect()->route('sk.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $sk = SK::findOrFail($id);
        $sk->delete();

        return redirect()->route('sk.index')->with('success', 'Data berhasil dihapus.');
    }
}
