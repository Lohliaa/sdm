@extends('layouts.master')
@section('judul')
@endsection
@section('judul_sub')
TAMBAH DATA MOU
@endsection
@section('content')

<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h4 class="font-weight-bold text-primary mb-0">TAMBAH DATA MOU GURU PEGAWAI SIT PERMATA</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops! Ada error saat menyimpan data:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('mou.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label>No SK</label>
                        <input type="text" name="no_sk" class="form-control" value="{{ old('no_sk') }}">
                    </div>
                    <div class="col-md-6">
                        <label>No Tambahan</label>
                        <input type="text" name="no_tambahan" class="form-control" value="{{ old('no_tambahan') }}">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Status Kepegawaian</label>
                        <input type="text" name="status_kepegawaian" class="form-control" value="{{ old('status_kepegawaian') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Status Detail</label>
                        <input type="text" name="status_detail" class="form-control" value="{{ old('status_detail') }}">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Gelar</label>
                        <input type="text" name="gelar" class="form-control" value="{{ old('gelar') }}">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Hari Kerja</label>
                        <input type="text" name="hari_kerja" class="form-control" value="{{ old('hari_kerja') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Jam Kerja</label>
                        <input type="text" name="jam_kerja" class="form-control" value="{{ old('jam_kerja') }}">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" value="{{ old('alamat') }}"></textarea>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Hari MoU</label>
                        <input type="text" name="hari" class="form-control" value="{{ old('hari') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Tanggal MoU</label>
                        <input type="date" name="tgl_mou" class="form-control" value="{{ old('tgl_mou') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Unit Kerja</label>
                        <input type="text" name="unit_kerja" class="form-control" value="{{ old('unit_kerja') }}">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Gaji Pokok</label>
                        <input type="number" name="gaji_pokok" class="form-control" value="{{ old('gaji_pokok') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Tunjangan Jabatan</label>
                        <input type="number" name="tunjangan_jabatan" class="form-control" value="{{ old('tunjangan_jabatan') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Tunjangan Transport</label>
                        <input type="number" name="tunjangan_transport" class="form-control" value="{{ old('tunjangan_transport') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Tunjangan Kinerja</label>
                        <input type="number" name="tunjangan_kinerja" class="form-control" value="{{ old('tunjangan_kinerja') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Tunjangan Fungsional</label>
                        <input type="number" name="tunjangan_fungsional" class="form-control" value="{{ old('tunjangan_fungsional') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>THP</label>
                        <input type="number" name="thp" class="form-control" value="{{ old('thp') }}">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Terbilang</label>
                        <input type="text" name="terbilang" class="form-control" value="{{ old('terbilang') }}">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" class="form-control" value="{{ old('tgl_mulai') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" class="form-control" value="{{ old('tanggal_akhir') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Berlaku (bulan)</label>
                        <input type="number" name="berlaku" class="form-control" value="{{ old('berlaku') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Saksi 1</label>
                        <input type="text" name="saksi1" class="form-control" value="{{ old('saksi1') }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Saksi 2</label>
                        <input type="text" name="saksi2" class="form-control" value="{{ old('saksi2') }}">
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                        <a href="{{ route('mou.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection