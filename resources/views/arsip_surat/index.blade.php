@extends('layouts.master')
@section('judul')
@endsection
@section('judul_sub')
Unggah Arsip Surat
@endsection
@section('content')

<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="display: flex; justify-content: space-between; align-items: center;">
            <ul>
                <h4 class="ml-0 font-weight-bold text-primary">Unggah Arsip Surat</h4>
                <li>Unggah surat yang telah terbit pada form ini untuk diarsipkan.</li>
                <li>Catatan! Gunakan file berformat PDF.</li>
            </ul>
        </div>
        <form action="{{ route('arsip_surat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container mt-4 mb-4">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <!-- Input Nomor Surat -->
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="nomorSurat" class="form-label">Nomor Surat:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nomorSurat" name="nomorSurat"
                                    placeholder="Masukkan nomor surat">
                            </div>
                        </div>

                        <!-- Dropdown Kategori -->
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="kategori" class="form-label">Kategori</label>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control" id="kategori" name="kategori">
                                    @foreach($kategori_surat as $kategori)
                                    <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Input Judul -->
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="judul" class="form-label">Judul:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="judul" name="judul"
                                    placeholder="Masukkan judul">
                            </div>
                        </div>

                        <!-- Unggah File -->
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="fileUpload" class="form-label">Unggah File (PDF):</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="fileUpload" name="fileUpload" accept=".pdf">
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-md btn-primary" href="{{ url('home') }}">KEMBALI</a>

                <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
            </div>

        </form>
    </div>
</body>
<script>
    // JavaScript to handle dropdown selection and updating the button text
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            const dropdownButton = document.getElementById('kategoriDropdown');
            dropdownButton.textContent = this.textContent; // Update button text
            dropdownButton.dataset.value = this.dataset.value; // Optionally update a data attribute
        });
    });
</script>

@endsection