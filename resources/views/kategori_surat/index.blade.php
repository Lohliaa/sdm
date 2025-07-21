@extends('layouts.master')
@section('judul')
{{-- Aplikasi | Project 2 Laravel JCC --}}
@endsection
@section('judul_sub')
Kategori Surat
@endsection
@section('content')

<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="display: flex; justify-content: space-between; align-items: center;">
            <ul>
                <h4 class="ml-0 font-weight-bold text-primary">Kategori Surat</h4>
                <li>Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat.</li>
                <li>Klik "Tambah" pada kolom aksi untuk menambahkan kategori surat.</li>
            </ul>
        </div>
        <div class="row justify-content-end">
            <div class="input-group col-md-4 mt-2 mb-2">
                <label for="searchp" class="ml-2 mr-3 mt-2" style="font-size: 12pt;">Cari surat:</label>
                <input type="text" name="search" id="searchp" class="form-control input-text" placeholder="Search"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>

            <!-- Tombol untuk memicu modal -->
            <a href="#" class="btn btn-success mr-5 mt-2" style="height: 40px;" data-bs-toggle="modal"
                data-bs-target="#addCategoryModal">Tambah Kategori Baru</a>

                <!-- Modal Tambah Kategori Baru -->
                <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori Baru</h5>
                            </div>
                            <div class="modal-body">
                                <!-- Menampilkan Nomor -->
                                <div class="mb-3">
                                    <label for="nomor_kategori" class="form-label">ID</label>
                                    <input type="text" class="form-control" id="nomor_kategori" readonly>
                                </div>
                                <form id="addCategoryForm" method="POST" action="{{ route('kategori_surat.store') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary" form="addCategoryForm">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                
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
                        Apakah anda yakin ingin menghapus kategori surat ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Ya!</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit Kategori -->
        <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
                    </div>
                    <div class="modal-body">
                        <form id="editCategoryForm" method="POST" action="{{ route('kategori_surat.update') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit_id" name="id">
                            <div class="mb-3">
                                <label for="edit_nama_kategori" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="edit_nama_kategori" name="nama_kategori" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="edit_keterangan" name="keterangan" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" form="editCategoryForm">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="filtered-data-container">
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped" id="ksTableBody">
                        <thead style="background-color: #263a74; color:white; position: sticky; top: 0;">
                            <tr>
                                <td style="vertical-align: middle;">No</td>
                                <td style="vertical-align: middle;">Nama Kategori</td>
                                <td style="vertical-align: middle;">Keterangan</td>
                                <td style="vertical-align: middle;">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($kategori_surat as $h)
                            <tr id="tr_{{ $h->id }}">
                                <td>{{ $no++ }}</td>
                                <td>{{ $h->nama_kategori }}</td>
                                <td>{{ $h->keterangan }}</td>
                                <td>
                                    <div class="d-flex">
                                        <form id="deleteForm_{{ $h->id }}"
                                            action="{{ route('kategori_surat.delete', $h->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger mr-2" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $h->id }}">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-info mr-2" data-bs-toggle="modal" data-bs-target="#editCategoryModal" data-id="{{ $h->id }}" data-nama="{{ $h->nama_kategori }}" data-keterangan="{{ $h->keterangan }}">
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
        var editCategoryModal = document.getElementById('editCategoryModal');
    
        editCategoryModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Tombol yang memicu modal
            
            // Ambil data dari atribut data-* tombol
            var id = button.getAttribute('data-id');
            var nama = button.getAttribute('data-nama');
            var keterangan = button.getAttribute('data-keterangan');
    
            // Isi data modal
            editCategoryModal.querySelector('#edit_id').value = id;
            editCategoryModal.querySelector('#edit_nama_kategori').value = nama;
            editCategoryModal.querySelector('#edit_keterangan').value = keterangan;
        });
    });
</script>    
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var addCategoryModal = document.getElementById('addCategoryModal');

        addCategoryModal.addEventListener('show.bs.modal', function () {
            // Dapatkan jumlah kategori saat ini
            var currentCount = document.querySelectorAll('tbody tr').length;
            // Set nomor baru
            var newNumber = currentCount + 1;
            document.getElementById('nomor_kategori').value = newNumber;
        });
    });
</script>
<script>
    function searchks() {
        const selected = document.getElementById('searchp').value;
    
        fetch(`{{ route('search.kategori_surat') }}?kategori_surat=${selected}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('ksTableBody').innerHTML = data;
            });
    }

document.getElementById('searchp').addEventListener('input', function() {
    searchks();
});

    function handleCheckboxChange(id) {
        console.log('Checkbox with ID ' + id + ' changed.');
    }
</script>

@endsection