@extends('layouts.master')
@section('judul')
{{-- Aplikasi | Project 2 Laravel JCC --}}
@endsection
@section('judul_sub')
Halaman Utama
@endsection
@section('content')

<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="display: flex; justify-content: space-between; align-items: center;">
            <ul>
                <h4 class="ml-0 font-weight-bold text-primary">Arsip Surat</h4>
                <li>Berikut ini adalah surat-surat yang telah diterbitkan dan diarsipkan.</li>
                <li>Klik "Lihat" pada kolom aksi untuk menampilkan surat.</li>
            </ul>
        </div>
        <div class="row justify-content-end">
            <div class="input-group col-md-4 mt-2 mb-2">
                <label for="searchp" class="ml-2 mr-3 mt-2" style="font-size: 12pt;">Cari surat:</label>
                <input type="text" name="search" id="searchp" class="form-control input-text" placeholder="Search"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
            <a href="{{ url('arsip_surat') }}" class="btn btn-success mr-5 mt-2" style="height: 40px;">Arsipkan
                Surat</a>
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
                        Apakah anda yakin ingin menghapus arsip surat ini?
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
                        <h5 class="modal-title" id="viewModalLabel">Detail Arsip Surat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <strong>Nomor Surat:</strong> <span id="viewNomor"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Kategori:</strong> <span id="viewKategori"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Judul:</strong> <span id="viewJudul"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Waktu Pengarsipan:</strong> <span id="viewWaktu"></span>
                        </div>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="viewFile" class="embed-responsive-item" src="" frameborder="0"
                                style="width: 100%; height: 500px;"></iframe>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Unduh Button -->
                        <a id="downloadButton" href="" class="btn btn-info" download>
                            <i class="bi bi-download"></i> Unduh Data
                        </a>                        

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Arsip -->
        <div class="modal fade" id="editArsipModal" tabindex="-1" aria-labelledby="editArsipModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editArsipModalLabel">Edit Arsip Surat</h5>
                    </div>
                    <div class="modal-body">
                        <form id="editArsipForm" method="POST" action="{{ route('arsip_surat.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit_id" name="id">
                            <div class="mb-3">
                                <label for="edit_nomor_surat" class="form-label">Nomor Surat</label>
                                <input type="text" class="form-control" id="edit_nomor_surat" name="nomor_surat"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_kategori" class="form-label">Kategori</label>
                                <select class="form-control" id="edit_kategori" name="kategori">
                                    @foreach($kategori_surat as $kategori)
                                    <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="edit_judul" name="judul" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_file_path" class="form-label">File Path</label>
                                <input type="file" class="form-control" id="edit_file_path" name="file_path"
                                    accept=".pdf">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" form="editArsipForm">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="filtered-data-container">
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped" id="homeTableBody">
                        <thead style="background-color: #263a74; color:white; position: sticky; top: 0;">
                            <tr>
                                <td style="vertical-align: middle;">No</td>
                                <td style="vertical-align: middle;">Nomor Surat</td>
                                <td style="vertical-align: middle;">Kategori</td>
                                <td style="vertical-align: middle;">Judul</td>
                                <td style="vertical-align: middle;">Waktu Pengarsipan</td>
                                <td style="vertical-align: middle;">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($arsip_surat as $h)
                            <tr id="tr_{{ $h->id }}">
                                <td>{{ $no++ }}</td>
                                <td>{{ $h->nomor_surat }}</td>
                                <td>{{ $h->kategori }}</td>
                                <td>{{ $h->judul }}</td>
                                <td>{{ $h->updated_at }}</td>
                                <td>
                                    <div class="d-flex">
                                        <form id="deleteForm_{{ $h->id }}" action="{{ route('home.delete', $h->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger mr-2" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $h->id }}">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                        {{-- <button onclick="exportData()" type="button" class="btn btn-info mr-2">
                                            <i class="bi bi-download"></i>
                                        </button> --}}
                                        <button type="button" class="btn btn-warning mr-2" data-bs-toggle="modal"
                                            data-bs-target="#viewModal" data-id="{{ $h->id }}"
                                            data-nomor="{{ $h->nomor_surat }}" data-kategori="{{ $h->kategori }}"
                                            data-judul="{{ $h->judul }}" data-waktu="{{ $h->updated_at }}"
                                            data-file="{{ $h->file_path }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-info mr-2" data-bs-toggle="modal"
                                            data-bs-target="#editArsipModal" data-id="{{ $h->id }}"
                                            data-nomor="{{ $h->nomor_surat }}" data-kategori="{{ $h->kategori }}"
                                            data-judul="{{ $h->judul }}" data-file="{{ $h->file_path }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
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
</body>
<script>
    $(document).ready(function() {
        @if(session('success'))
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @elseif(session('error'))
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        @endif
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = document.getElementById('deleteModal');
        var confirmDeleteButton = document.getElementById('confirmDelete');
        var formToSubmit;

        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Tombol yang memicu modal
            var id = button.getAttribute('data-id'); // Ekstrak info dari atribut data-*
            formToSubmit = document.getElementById('deleteForm_' + id);
        });

        confirmDeleteButton.addEventListener('click', function () {
            formToSubmit.submit(); // Submit form ketika tombol konfirmasi di klik
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var viewModal = document.getElementById('viewModal');
    
        viewModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Tombol yang memicu modal
            
            // Ambil data dari atribut data-* tombol
            var nomor = button.getAttribute('data-nomor');
            var kategori = button.getAttribute('data-kategori');
            var judul = button.getAttribute('data-judul');
            var waktu = button.getAttribute('data-waktu');
            var file = button.getAttribute('data-file');
            var id = button.getAttribute('data-id'); // Menyimpan ID arsip surat
    
            // Isi data modal
            viewModal.querySelector('#viewNomor').textContent = nomor;
            viewModal.querySelector('#viewKategori').textContent = kategori;
            viewModal.querySelector('#viewJudul').textContent = judul;
            viewModal.querySelector('#viewWaktu').textContent = waktu;
            viewModal.querySelector('#viewFile').src = file;
    
            // Update href tombol unduh
            var downloadButton = viewModal.querySelector('#downloadButton');
            downloadButton.href = '/arsip_surat/download/' + id;
        });
    });    
</script>

<script>
    function searchHome() {
        const selected = document.getElementById('searchp').value;
    
        fetch(`{{ route('search.home') }}?home=${selected}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('homeTableBody').innerHTML = data;
            });
    }

document.getElementById('searchp').addEventListener('input', function() {
    searchHome();
});

    function handleCheckboxChange(id) {
        console.log('Checkbox with ID ' + id + ' changed.');
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editArsipModal = document.getElementById('editArsipModal');
    
        editArsipModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Tombol yang memicu modal
            
            // Ambil data dari atribut data-* tombol
            var id = button.getAttribute('data-id');
            var nomor = button.getAttribute('data-nomor');
            var kategori = button.getAttribute('data-kategori');
            var judul = button.getAttribute('data-judul');
    
            // Isi data modal
            editArsipModal.querySelector('#edit_id').value = id;
            editArsipModal.querySelector('#edit_nomor_surat').value = nomor;
            editArsipModal.querySelector('#edit_judul').value = judul;
    
            // Set nilai dropdown kategori
            var kategoriDropdown = editArsipModal.querySelector('#edit_kategori');
            kategoriDropdown.value = kategori; // Set dropdown value berdasarkan kategori yang diterima
        });
    });
</script>


@endsection