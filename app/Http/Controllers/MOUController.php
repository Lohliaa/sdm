<?php

namespace App\Http\Controllers;

use App\Exports\MOUExport;
use App\Helpers\DateHelper;
use App\Imports\MouImport;
use App\Models\MOU;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use setasign\Fpdi\Tcpdf\Fpdi;

class MOUController extends Controller
{

    public function index()
    {
        $mou = MOU::orderBy('id', 'asc')->get();
        $data = $mou->all();

        $fields = ['tgl_mou', 'tanggal_lahir', 'tgl_mulai', 'tanggal_akhir'];

        foreach ($data as $item) {
            foreach ($fields as $field) {
                $item->{$field} = DateHelper::formatFlexible($item->{$field});
            }
        }


        return view('mou.index', compact('mou', 'data'));
    }

    public function searchMOU(Request $request)
    {
        $mou = $request->input('mou');

        // Lakukan pencarian berdasarkan input
        $mou = MOU::where('no_sk', 'LIKE', "%$mou%")
            ->orWhere('no_tambahan', 'LIKE', "%$mou%")
            ->orWhere('status_kepegawaian', 'LIKE', "%$mou%")
            ->orWhere('status_detail', 'LIKE', "%$mou%")
            ->orWhere('nama', 'LIKE', "%$mou%")
            ->orWhere('gelar', 'LIKE', "%$mou%")
            ->orWhere('hari_kerja', 'LIKE', "%$mou%")
            ->orWhere('jam_kerja', 'LIKE', "%$mou%")
            ->orWhere('alamat', 'LIKE', "%$mou%")
            ->orWhere('hari', 'LIKE', "%$mou%")
            ->orWhere('tgl_mou', 'LIKE', "%$mou%")
            ->orWhere('tempat_lahir', 'LIKE', "%$mou%")
            ->orWhere('tanggal_lahir', 'LIKE', "%$mou%")
            ->orWhere('unit_kerja', 'LIKE', "%$mou%")
            ->orWhere('gaji_pokok', 'LIKE', "%$mou%")
            ->orWhere('tunjangan_jabatan', 'LIKE', "%$mou%")
            ->orWhere('tunjangan_transport', 'LIKE', "%$mou%")
            ->orWhere('tunjangan_kinerja', 'LIKE', "%$mou%")
            ->orWhere('tunjangan_fungsional', 'LIKE', "%$mou%")
            ->orWhere('thp', 'LIKE', "%$mou%")
            ->orWhere('terbilang', 'LIKE', "%$mou%")
            ->orWhere('tgl_mulai', 'LIKE', "%$mou%")
            ->orWhere('berlaku', 'LIKE', "%$mou%")
            ->orWhere('tanggal_akhir', 'LIKE', "%$mou%")
            ->orWhere('saksi1', 'LIKE', "%$mou%")
            ->orWhere('saksi2', 'LIKE', "%$mou%")
            ->get();

        // Kembalikan view dengan hasil pencarian
        return response()->view('mou.partialmou', compact('mou'));
    }

    public function create()
    {
        return view('mou.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_sk' => 'required',
            'no_tambahan' => 'required',
            'status_kepegawaian' => 'required',
            'status_detail' => 'required',
            'nama' => 'required',
            'gelar' => 'required',
            'hari_kerja' => 'required',
            'jam_kerja' => 'required',
            'alamat' => 'required',
            'hari' => 'required',
            'tgl_mou' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'unit_kerja' => 'required',
            'gaji_pokok' => 'required',
            'tunjangan_jabatan' => 'required',
            'tunjangan_transport' => 'required',
            'tunjangan_kinerja' => 'required',
            'tunjangan_fungsional' => 'required',
            'thp' => 'required',
            'terbilang' => 'required',
            'tgl_mulai' => 'required',
            'berlaku' => 'required',
            'tanggal_akhir' => 'required',
            'saksi1' => 'required',
            'saksi2' => 'required'
        ]);

        $mou = MOU::create([
            'no_sk' => $request->no_sk,
            'no_tambahan' => $request->no_tambahan,
            'status_kepegawaian' => $request->status_kepegawaian,
            'status_detail' => $request->status_detail,
            'nama' => $request->nama,
            'gelar' => $request->gelar,
            'hari_kerja' => $request->hari_kerja,
            'jam_kerja' => $request->jam_kerja,
            'alamat' => $request->alamat,
            'hari' => $request->hari,
            'tgl_mou' => $request->tgl_mou,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'unit_kerja' => $request->unit_kerja,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan_jabatan' => $request->tunjangan_jabatan,
            'tunjangan_transport' => $request->tunjangan_transport,
            'tunjangan_kinerja' => $request->tunjangan_kinerja,
            'tunjangan_fungsional' => $request->tunjangan_fungsional,
            'thp' => $request->thp,
            'terbilang' => $request->terbilang,
            'tgl_mulai' => $request->tgl_mulai,
            'berlaku' => $request->berlaku,
            'tanggal_akhir' => $request->tanggal_akhir,
            'saksi1' => $request->saksi1,
            'saksi2' => $request->saksi2,

        ]);
        return redirect()->route('mou.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function export()
    {
        return Excel::download(new MOUExport, 'Data MOU Gupeg SIT Permata.xlsx');
    }

    public function upload()
    {
        return view('mou.index'); // Buat view ini nanti
    }

    public function uploadProcess(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv', // Sesuaikan dengan kebutuhan
        ]);

        // Contoh: menyimpan file upload ke storage
        $path = $request->file('file')->store('uploads');

        // Jika menggunakan Laravel Excel (opsional)
        Excel::import(new MouImport, $request->file('file'));

        return redirect()->route('mou.index')->with('success', 'Data berhasil diupload.');
    }

    public function edit($id)
    {
        $mou = Mou::findOrFail($id);
        return view('mou.edit', compact('mou'));
    }

    public function update(Request $request, $id)
    {
        $mou = Mou::findOrFail($id);

        // Validasi dan update data
        $mou->update($request->all());

        return redirect()->route('mou.index')->with('success', 'Data berhasil diupdate.');
    }


    public function destroy($id)
    {
        $mou = Mou::findOrFail($id);
        $mou->delete();

        return redirect()->route('mou.index')->with('success', 'Data berhasil dihapus.');
    }
}
