@extends('layouts.master')
@section('judul')
@endsection
@section('judul_sub')
SK
@endsection
@section('content')

<!-- Tambahkan di <head> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h4 class="font-weight-bold text-primary mb-0">SK GURU PEGAWAI SIT PERMATA MOJOKERTO</h4>
        </div>
        <div class="row justify-content-end">
            <div class="input-group col-md-4 mt-2 mb-2">
                <label for="searchSK" class="ml-2 mr-3 mt-2" style="font-size: 12pt;">Cari SK:</label>
                <input type="text" name="search" id="searchSK" class="form-control input-text" placeholder="Search"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
            <a href="{{ route('sk.create') }}" class="btn btn-success mr-2 mt-2" style="height: 38px;"><i class="bi bi-plus-square"></i></a>
            <form action="{{ route('sk.upload.process') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                <input type="file" name="file" id="fileInput" class="d-none" required>
                <button type="button" class="btn btn-secondary mr-2 mt-2" onclick="document.getElementById('fileInput').click();">
                    <i class="bi bi-upload"></i></button>
            </form>
            <a href="{{ route('sk.export') }}" class="btn btn-info mr-5 mt-2" style="height: 38px;"><i class="bi bi-download"></i></a>

        </div>

        <!-- Modal Gagal -->
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Gagal menyimpan data! Silakan coba lagi.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Delete-->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Ya!</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Lihat -->
        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">Detail Data SK</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <strong>No SK:</strong> <span id="viewNoSK"></span>
                        </div>
                        <div class="mb-3">
                            <strong>No Tambahan:</strong> <span id="viewSKtambahan"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Nama:</strong> <span id="viewNama"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Gelar:</strong> <span id="viewGelar"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Tempat Lahir:</strong> <span id="viewTempatLahir"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal Lahir:</strong> <span id="viewTanggalLahir"></span>
                        </div>
                        <div class="mb-3">
                            <strong>NIPY:</strong> <span id="viewNIPY"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Gol Ruang:</strong> <span id="viewGolRuang"></span>
                        </div>

                        <div class="mb-3">
                            <strong>Status Kepegawaian:</strong> <span id="viewStatusKepegawaian"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Unit Kerja:</strong> <span id="viewUnitKerja"></span>
                        </div>
                        <div class="mb-3">
                            <strong>TMT:</strong> <span id="viewTMT"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal Mulai:</strong> <span id="viewTanggalMulai"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Berlaku:</strong> <span id="viewBerlaku"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal Akhir:</strong> <span id="viewTanggalAkhir"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal Ditetapkan:</strong> <span id="viewTanggalDitetapkan"></span>
                        </div>

                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="viewFile" class="embed-responsive-item" src="" frameborder="0"
                                style="width: 100%; height: 500px;"></iframe>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="filtered-data-container">
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped" id="skTableBody">
                        <thead style="background-color: #263a74; color:white; position: sticky; top: 0;">
                            <tr>
                                <td style="vertical-align: middle;">No</td>
                                <td style="vertical-align: middle;">No SK</td>
                                <td style="vertical-align: middle;">No Tambahan</td>
                                <td style="vertical-align: middle;">Nama</td>
                                <td style="vertical-align: middle;">Gelar</td>
                                <td style="vertical-align: middle;">Tempat Lahir</td>
                                <td style="vertical-align: middle;">Tanggal Lahir</td>
                                <td style="vertical-align: middle;">NIPY</td>
                                <td style="vertical-align: middle;">Gol Ruang</td>
                                <td style="vertical-align: middle;">Status Kepegawaian</td>
                                <td style="vertical-align: middle;">Unit Kerja</td>
                                <td style="vertical-align: middle;">TMT</td>
                                <td style="vertical-align: middle;">Tanggal Mulai</td>
                                <td style="vertical-align: middle;">Berlaku</td>
                                <td style="vertical-align: middle;">Tanggal Akhir</td>
                                <td style="vertical-align: middle;">Tanggal Ditetapkan</td>
                                <td style="vertical-align: middle;">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            @foreach ($sk as $h)
                            <tr id="tr_{{ $h->id }}">
                                <td>{{ $no++ }}</td>
                                <td>{{ $h->no_sk }}</td>
                                <td>{{ $h->no_tambahan }}</td>
                                <td>{{ $h->nama }}</td>
                                <td>{{ $h->gelar }}</td>
                                <td>{{ $h->tempat_lahir }}</td>
                                <td>{{ $h->tanggal_lahir}}</td>
                                <td>{{ $h->nipy }}</td>
                                <td>{{ $h->gol_ruang }}</td>
                                <td>{{ $h->status_kepegawaian }}</td>
                                <td>{{ $h->unit_kerja }}</td>
                                <td>{{ $h->tmt }}</td>
                                <td>{{ $h->tanggal_mulai }}</td>
                                <td>{{ $h->berlaku }}</td>
                                <td>{{ $h->tanggal_akhir }}</td>
                                <td>{{ $h->tanggal_ditetapkan }}</td>
                                <td>
                                    <div class="d-flex">
                                        <form id="deleteForm_{{ $h->id }}" action="{{ route('sk.destroy', $h->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger mr-2" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $h->id }}">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-warning mr-2" data-bs-toggle="modal"
                                            data-bs-target="#viewModal" data-noSK="{{ $h->no_sk }}"
                                            data-skTambahan="{{ $h->no_tambahan }}"
                                            data-nama="{{ $h->nama }}" data-gelar="{{ $h->gelar }}"
                                            data-tempat_lahir="{{ $h->tempat_lahir }}" data-tanggal_lahir="{{ $h->tanggal_lahir }}"
                                            data-nipy="{{ $h->nipy }}" data-gol_ruang="{{ $h->gol_ruang }}"
                                            data-status_kepegawaian="{{ $h->status_kepegawaian }}" data-unit_kerja="{{ $h->unit_kerja }}"
                                            data-tmt="{{ $h->tmt }}" data-tanggal_mulai="{{ $h->tanggal_mulai }}"
                                            data-berlaku="{{ $h->berlaku }}" data-tanggal_akhir="{{ $h->tanggal_akhir }}"
                                            data-tanggal_ditetapkan="{{ $h->tanggal_ditetapkan }}"><i class="bi bi-eye"></i>
                                        </button>
                                        <a href="{{ route('sk.edit', $h->id) }}" class="btn btn-primary mr-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $sk->links() }}
        </div>
    </div>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('
            success ') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

</body>

<script>
    // Submit form otomatis saat file dipilih
    document.getElementById('fileInput').addEventListener('change', function() {
        if (this.files.length > 0) {
            document.getElementById('uploadForm').submit();
        }
    });
</script>
<!-- Script untuk menangani konfirmasi hapus -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = document.getElementById('deleteModal');
        var confirmDeleteButton = document.getElementById('confirmDelete');
        var formToSubmit;

        // Pastikan event listener hanya aktif jika modal dan tombol ada
        if (deleteModal && confirmDeleteButton) {
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                formToSubmit = document.getElementById('deleteForm_' + id);
            });

            confirmDeleteButton.addEventListener('click', function() {
                if (formToSubmit) {
                    formToSubmit.submit();
                }
            });
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var viewModal = document.getElementById('viewModal');

        viewModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Tombol yang memicu modal

            // Ambil data dari atribut data-* tombol
            var no_sk = button.getAttribute('data-noSK');
            var no_tambahan = button.getAttribute('data-skTambahan');
            var nama = button.getAttribute('data-nama');
            var gelar = button.getAttribute('data-gelar');
            var tempat_lahir = button.getAttribute('data-tempat_lahir');
            var tanggal_lahir = button.getAttribute('data-tanggal_lahir');
            var nipy = button.getAttribute('data-nipy');
            var gol_ruang = button.getAttribute('data-gol_ruang');
            var status_kepegawaian = button.getAttribute('data-status_kepegawaian');
            var unit_kerja = button.getAttribute('data-unit_kerja');
            var tmt = button.getAttribute('data-tmt');
            var tanggal_mulai = button.getAttribute('data-tanggal_mulai');
            var berlaku = button.getAttribute('data-berlaku');
            var tanggal_akhir = button.getAttribute('data-tanggal_akhir');
            var tanggal_ditetapkan = button.getAttribute('data-tanggal_ditetapkan');

            // Isi data modal
            viewModal.querySelector('#viewNoSK').textContent = no_sk;
            viewModal.querySelector('#viewSKtambahan').textContent = no_tambahan;
            viewModal.querySelector('#viewNama').textContent = nama;
            viewModal.querySelector('#viewGelar').textContent = gelar;
            viewModal.querySelector('#viewTempatLahir').textContent = tempat_lahir;
            viewModal.querySelector('#viewTanggalLahir').textContent = tanggal_lahir;
            viewModal.querySelector('#viewNIPY').textContent = nipy;
            viewModal.querySelector('#viewGolRuang').textContent = gol_ruang;
            viewModal.querySelector('#viewStatusKepegawaian').textContent = status_kepegawaian;
            viewModal.querySelector('#viewUnitKerja').textContent = unit_kerja;
            viewModal.querySelector('#viewTMT').textContent = tmt;
            viewModal.querySelector('#viewTanggalMulai').textContent = tanggal_mulai;
            viewModal.querySelector('#viewBerlaku').textContent = berlaku;
            viewModal.querySelector('#viewTanggalAkhir').textContent = tanggal_akhir;
            viewModal.querySelector('#viewTanggalDitetapkan').textContent = tanggal_ditetapkan;
        });
    });
</script>

<script>
    function searchSK() {
        const selected = document.getElementById('searchSK').value;

        fetch(`{{ route('search.sk') }}?sk=${encodeURIComponent(selected)}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('skTableBody').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }

    document.getElementById('searchSK').addEventListener('input', function() {
        searchSK();
    });
</script>


@endsection