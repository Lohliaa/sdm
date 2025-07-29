@extends('layouts.master')
@section('judul')
@endsection
@section('judul_sub')
MOU
@endsection
@section('content')

<!-- Tambahkan di <head> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h4 class="font-weight-bold text-primary mb-0">MOU GURU PEGAWAI SIT PERMATA MOJOKERTO</h4>
        </div>
        <div class="row justify-content-end">
            <div class="input-group col-md-4 mt-2 mb-2">
                <label for="searchp" class="ml-2 mr-3 mt-2" style="font-size: 12pt;">Cari MoU:</label>
                <input type="text" name="search" id="searchp" class="form-control input-text" placeholder="Search"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
            <a href="{{ route('mou.create') }}" class="btn btn-success mr-2 mt-2" style="height: 38px;"><i class="bi bi-plus-square"></i></a>
            <form action="{{ route('mou.upload.process') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                 <input type="file" name="file" id="fileInput" class="d-none" required>
                <button type="button" class="btn btn-primary mr-5 mt-2" onclick="document.getElementById('fileInput').click();">
                    <i class="bi bi-upload"></i></button>
            </form>
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
                        <h5 class="modal-title" id="viewModalLabel">Detail Data MOU</h5>
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
                            <strong>Status Kepegawaian:</strong> <span id="viewKepegawaian"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Status Detail:</strong> <span id="viewDetail"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Nama:</strong> <span id="viewNama"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Gelar:</strong> <span id="viewGelar"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Hari Kerja:</strong> <span id="viewHariKerja"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Jam Kerja:</strong> <span id="viewJamKerja"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Alamat:</strong> <span id="viewAlamat"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Hari MoU:</strong> <span id="viewHari"></span>
                        </div>

                        <div class="mb-3">
                            <strong>Tanggal MoU:</strong> <span id="viewTanggalMOU"></span>
                        </div>
                        <div class="mb-3">
                            <strong>TTL:</strong> <span id="viewTTL"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Unit Kerja:</strong> <span id="viewUnit"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Gaji Pokok:</strong> <span id="viewGaji"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Tunjangan Jabatan:</strong> <span id="viewTJabatan"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Tunjangan Transport:</strong> <span id="viewTTransport"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Tunjangan Kinerja:</strong> <span id="viewTKinerja"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Tunjangan Fungsional:</strong> <span id="viewTFungsional"></span>
                        </div>
                        <div class="mb-3">
                            <strong>THP:</strong> <span id="viewThp"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Terbilang:</strong> <span id="viewTerbilang"></span>
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
                            <strong>Saksi 1:</strong> <span id="viewSaksi1"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Saksi 2:</strong> <span id="viewSaksi2"></span>
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
                    <table class="table table-striped" id="mouTableBody">
                        <thead style="background-color: #263a74; color:white; position: sticky; top: 0;">
                            <tr>
                                <td style="vertical-align: middle;">No</td>
                                <td style="vertical-align: middle;">No SK</td>
                                <td style="vertical-align: middle;">No Tambahan</td>
                                <td style="vertical-align: middle;">Status Kepegawaian</td>
                                <td style="vertical-align: middle;">Status Detail</td>
                                <td style="vertical-align: middle;">Nama</td>
                                <td style="vertical-align: middle;">Gelar</td>
                                <td style="vertical-align: middle;">Hari Kerja</td>
                                <td style="vertical-align: middle;">Jam Kerja</td>
                                <td style="vertical-align: middle;">Alamat</td>
                                <td style="vertical-align: middle;">Hari MoU</td>
                                <td style="vertical-align: middle;">Tanggal MoU</td>
                                <td style="vertical-align: middle;">Tempat Lahir</td>
                                <td style="vertical-align: middle;">Tanggal Lahir</td>
                                <td style="vertical-align: middle;">Unit Kerja</td>
                                <td style="vertical-align: middle;">Gaji Pokok</td>
                                <td style="vertical-align: middle;">Tunjangan Jabatan</td>
                                <td style="vertical-align: middle;">Tunjangan Transport</td>
                                <td style="vertical-align: middle;">Tunjangan Kinerja</td>
                                <td style="vertical-align: middle;">Tunjangan Fungsional</td>
                                <td style="vertical-align: middle;">THP</td>
                                <td style="vertical-align: middle;">Terbilang</td>
                                <td style="vertical-align: middle;">Tanggal Mulai</td>
                                <td style="vertical-align: middle;">Berlaku (bulan)</td>
                                <td style="vertical-align: middle;">Tanggal Akhir</td>
                                <td style="vertical-align: middle;">Saksi 1</td>
                                <td style="vertical-align: middle;">Saksi 2</td>
                                <td style="vertical-align: middle;">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            @foreach ($mou as $h)
                            <tr id="tr_{{ $h->id }}">
                                <td>{{ $no++ }}</td>
                                <td>{{ $h->no_sk }}</td>
                                <td>{{ $h->no_tambahan }}</td>
                                <td>{{ $h->status_kepegawaian }}</td>
                                <td>{{ $h->status_detail }}</td>
                                <td>{{ $h->nama }}</td>
                                <td>{{ $h->gelar }}</td>
                                <td>{{ $h->hari_kerja }}</td>
                                <td>{{ $h->jam_kerja }}</td>
                                <td>{{ $h->alamat }}</td>
                                <td>{{ $h->hari }}</td>
                                <td>{{ $h->tgl_mou }}</td>
                                <td>{{ $h->tempat_lahir }}</td>
                                <td>{{ $h->tanggal_lahir }}</td>
                                <td>{{ $h->unit_kerja }}</td>
                                <td>{{ $h->gaji_pokok }}</td>
                                <td>{{ $h->tunjangan_jabatan }}</td>
                                <td>{{ $h->tunjangan_transport }}</td>
                                <td>{{ $h->tunjangan_kinerja }}</td>
                                <td>{{ $h->tunjangan_fungsional }}</td>
                                <td>{{ $h->thp }}</td>
                                <td>{{ $h->terbilang }}</td>
                                <td>{{ $h->tgl_mulai }}</td>
                                <td>{{ $h->berlaku }}</td>
                                <td>{{ $h->tanggal_akhir }}</td>
                                <td>{{ $h->saksi1 }}</td>
                                <td>{{ $h->saksi2 }}</td>
                                <td>
                                    <div class="d-flex">
                                        <form id="deleteForm_{{ $h->id }}" action="{{ route('mou.destroy', $h->id) }}"
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
                                            data-skTambahan="{{ $h->no_tambahan }}" data-kepegawaian="{{ $h->status_kepegawaian }}" data-detail="{{ $h->status_detail }}"
                                            data-nama="{{ $h->nama }}" data-gelar="{{ $h->gelar }}"
                                            data-hari_kerja="{{ $h->hari_kerja }}" data-jam_kerja="{{ $h->jam_kerja }}"
                                            data-alamat="{{ $h->alamat }}" data-hari="{{ $h->hari }}"
                                            data-tanggal_mou="{{ $h->tgl_mou }}" data-TTL="{{ $h->tanggal_lahir }}"
                                            data-unit="{{ $h->unit_kerja }}" data-gaji="{{ $h->gaji_pokok }}"
                                            data-TJabatan="{{ $h->tunjangan_jabatan }}" data-TTransport="{{ $h->tunjangan_transport }}"
                                            data-TKinerja="{{ $h->tunjangan_kinerja }}" data-TFungsional="{{ $h->tunjangan_fungsional }}"
                                            data-thp="{{ $h->thp }}" data-terbilang="{{ $h->terbilang }}"
                                            data-tgl_mulai="{{ $h->tgl_mulai }}" data-berlaku="{{ $h->berlaku }}"
                                            data-tanggal_akhir="{{ $h->tanggal_akhir }}" data-saksi1="{{ $h->saksi1 }}"
                                            data-saksi2="{{ $h->saksi2 }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <a href="{{ route('mou.edit', $h->id) }}" class="btn btn-secondary mr-2">
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
            var status_kepegawaian = button.getAttribute('data-kepegawaian');
            var status_detail = button.getAttribute('data-detail');
            var nama = button.getAttribute('data-nama');
            var gelar = button.getAttribute('data-gelar');
            var hari_kerja = button.getAttribute('data-hari_kerja');
            var jam_kerja = button.getAttribute('data-jam_kerja');
            var alamat = button.getAttribute('data-alamat');
            var hari = button.getAttribute('data-hari');
            var tanggal_mou = button.getAttribute('data-tanggal_mou');
            var TTL = button.getAttribute('data-TTL');
            var unit = button.getAttribute('data-unit');
            var gaji = button.getAttribute('data-gaji');
            var TJabatan = button.getAttribute('data-TJabatan');
            var TTransport = button.getAttribute('data-TTransport');
            var TKinerja = button.getAttribute('data-TKinerja');
            var TFungsional = button.getAttribute('data-TFungsional');
            var thp = button.getAttribute('data-thp');
            var terbilang = button.getAttribute('data-terbilang');
            var tgl_mulai = button.getAttribute('data-tgl_mulai');
            var berlaku = button.getAttribute('data-berlaku');
            var tanggal_akhir = button.getAttribute('data-tanggal_akhir');
            var saksi1 = button.getAttribute('data-saksi1');
            var saksi2 = button.getAttribute('data-saksi2');

            // Isi data modal
            viewModal.querySelector('#viewNoSK').textContent = no_sk;
            viewModal.querySelector('#viewSKtambahan').textContent = no_tambahan;
            viewModal.querySelector('#viewKepegawaian').textContent = status_kepegawaian;
            viewModal.querySelector('#viewDetail').textContent = status_detail;
            viewModal.querySelector('#viewNama').textContent = nama;
            viewModal.querySelector('#viewGelar').textContent = gelar;
            viewModal.querySelector('#viewHariKerja').textContent = hari_kerja;
            viewModal.querySelector('#viewJamKerja').textContent = jam_kerja;
            viewModal.querySelector('#viewAlamat').textContent = alamat;
            viewModal.querySelector('#viewHari').textContent = hari;
            viewModal.querySelector('#viewTanggalMOU').textContent = tanggal_mou;
            viewModal.querySelector('#viewTTL').textContent = TTL;
            viewModal.querySelector('#viewUnit').textContent = unit;
            viewModal.querySelector('#viewGaji').textContent = gaji;
            viewModal.querySelector('#viewTJabatan').textContent = TJabatan;
            viewModal.querySelector('#viewTTransport').textContent = TTransport;
            viewModal.querySelector('#viewTKinerja').textContent = TKinerja;
            viewModal.querySelector('#viewTFungsional').textContent = TFungsional;
            viewModal.querySelector('#viewThp').textContent = thp;
            viewModal.querySelector('#viewTerbilang').textContent = terbilang;
            viewModal.querySelector('#viewTanggalMulai').textContent = tgl_mulai;
            viewModal.querySelector('#viewBerlaku').textContent = berlaku;
            viewModal.querySelector('#viewTanggalAkhir').textContent = tanggal_akhir;
            viewModal.querySelector('#viewSaksi1').textContent = saksi1;
            viewModal.querySelector('#viewSaksi2').textContent = saksi2;
        });
    });
</script>

<script>
    function searchMOU() {
        const selected = document.getElementById('searchp').value;

        fetch(`{{ route('search.mou') }}?mou=${encodeURIComponent(selected)}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('mouTableBody').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }

    document.getElementById('searchp').addEventListener('input', function () {
        searchMOU();
    });
</script>


@endsection