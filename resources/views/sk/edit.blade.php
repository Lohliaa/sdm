@extends('layouts.master')
@section('judul')
@endsection
@section('judul_sub')
EDIT DATA SK
@endsection
@section('content')

<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h4 class="font-weight-bold text-primary mb-0">EDIT DATA SK GURU PEGAWAI SIT PERMATA</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('sk.update', $sk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <label>No SK</label>
                        <input type="text" name="no_sk" class="form-control" value="{{ $sk->no_sk }}" required>
                    </div>
                    <div class="col-md-6">
                        <label>No Tambahan</label>
                        <input type="text" name="no_tambahan" class="form-control" value="{{ $sk->no_tambahan }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $sk->nama }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Gelar</label>
                        <input type="text" name="gelar" class="form-control" value="{{ $sk->gelar }}">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ $sk->tempat_lahir }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $sk->tanggal_lahir }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>NIPY</label>
                        <input type="text" name="nipy" class="form-control" value="{{ $sk->nipy }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Gol Ruang</label>
                        <input type="text" name="gol_ruang" class="form-control" value="{{ $sk->gol_ruang }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Status Kepegawaian</label>
                        <input type="text" name="status_kepegawaian" class="form-control" value="{{ $sk->status_kepegawaian }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Unit Kerja</label>
                        <input type="text" name="unit_kerja" class="form-control" value="{{ $sk->unit_kerja }}">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>TMT</label>
                        <input type="date" name="tmt" class="form-control" value="{{ $sk->tmt }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control" value="{{ $sk->tanggal_mulai }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Berlaku (bulan)</label>
                        <input type="number" name="berlaku" class="form-control" value="{{ $sk->berlaku }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Tanggal Akhir</label>
                        <input type="text" name="tanggal_akhir" class="form-control" value="{{ $sk->tanggal_akhir }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Tanggal Ditetapkan</label>
                        <input type="text" name="tanggal_ditetapkan" class="form-control" value="{{ $sk->tanggal_ditetapkan }}">
                    </div>


                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('sk.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection