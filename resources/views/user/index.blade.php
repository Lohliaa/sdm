@extends('layouts.master')
@section('judul')
@endsection
@section('judul_sub')
Profile
@endsection
@section('content')

<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="display: flex; justify-content: space-between; align-items: center;">
            <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
        </div>
        <div class="row justify-content-between" style="align-items: center;">
            <div class="form-group col-md-6 ml-4" style="margin-left: 12px">

                <a href="{{ route('user.create') }}" class="btn btn-success mt-3" style="height: 38px;"><i class="bi bi-plus-square"></i></a>

                <!-- Modal pesan sukses -->
                <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                    aria-labelledby="successModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="successModalLabel">Pesan Sukses</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Data berhasil direset.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
            </div>

            <div class="input-group col-md-3 mr-4">
                <input type="text" name="search" style="height: 2.4rem; font-size: 12pt; margin-top: 0.10rem;"
                    id="searchUser" class="form-control input-text" placeholder="Cari disini ..."
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-striped" id="pTableBody">
                    <thead style="background-color: #263a74; color:white; position: sticky; top: 0;">
                        <tr>
                            <td colspan="0" rowspan="3" style="vertical-align: middle;">No</td>
                            <td colspan="0" rowspan="3" style="vertical-align: middle;">Username</td>
                            <td colspan="0" rowspan="3" style="vertical-align: middle;">Email</td>
                            <td colspan="0" rowspan="3" style="vertical-align: middle;">Password</td>
                            <td colspan="0" rowspan="3" style="vertical-align: middle;">Status</td>
                            <td colspan="0" rowspan="3" style="vertical-align: middle;">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @foreach ($user as $kb)
                        <tr id="tr_{{ $kb->id }}">
                            <td>{{$no++}}</td>
                            <td>{{ $kb->name }}</td>
                            <td>{{ $kb->email }}</td>
                            <td>
                                <div class="password-container">
                                    <input type="password" class="password-text" value="{{ $kb->chain }}" readonly>
                                    <i class="toggle-password-icon bi bi-eye-slash-fill"
                                        onclick="togglePasswordVisibility(this)"></i>
                                </div>
                            </td>
                            <td>{{ $kb->role }}</td>
                            <td>
                                <div class="d-flex">
                                    <form id="deleteForm_{{ $kb->id }}" action="{{ route('user.destroy', $kb->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger mr-2" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $kb->id }}">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('user.edit', $kb->id) }}" class="btn btn-primary mr-2">
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
    function togglePasswordVisibility(icon) {
        var passwordInput = icon.previousElementSibling;
        var type = passwordInput.getAttribute('type');

        if (type === 'password') {
            passwordInput.setAttribute('type', 'text');
            icon.classList.remove('bi-eye-slash-fill');
            icon.classList.add('bi-eye-fill');
        } else {
            passwordInput.setAttribute('type', 'password');
            icon.classList.remove('bi-eye-fill');
            icon.classList.add('bi-eye-slash-fill');
        }
    }
</script>

<script>
    // Fungsi untuk mengirim permintaan pencarian ke server dan mengganti konten tabel
    function searchUser() {
        const selected = document.getElementById('searchUser').value;

        fetch(`{{ route('search.user') }}?user=${selected}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('pTableBody').innerHTML = data;
            });
    }

    // Menambahkan event listener untuk input pencarian
    document.getElementById('searchUser').addEventListener('input', function() {
        searchUser();
    });

    // Fungsi yang akan dipanggil ketika checkbox berubah
    function handleCheckboxChange(id) {
        // Tambahkan logika yang sesuai untuk menangani perubahan checkbox di sini
        console.log('Checkbox with ID ' + id + ' changed.');
    }
</script>

<script>
    function disableButtons() {
        const buttonSwitch = document.getElementById('buttonSwitch');
        const buttons = document.querySelectorAll('.home-button');

        buttons.forEach(button => {
            if (buttonSwitch.checked) {
                button.disabled = true;
            } else {
                button.disabled = false;
            }
        });
    }
    document.getElementById("master").addEventListener("click", function() {
        var checkboxes = document.querySelectorAll('.sub_chk');
        checkboxes.forEach(function(checkbox) {
            var row = checkbox.closest('tr');
            var role = row.querySelector('td:last-child').textContent;
            if (role.trim() !== 'Admin') {
                checkbox.checked = document.getElementById("master").checked;
            }
        });
    });

    // JavaScript to handle checkbox change
    function handleCheckboxChange() {
        const selectedCheckboxes = document.querySelectorAll('.sub_chk:checked');
        const editButton = document.querySelector('#editButton');
        const deleteButton = document.querySelector('#deleteButton'); // Tambahkan tombol Hapus

        if (selectedCheckboxes.length === 1) {
            editButton.removeAttribute('disabled');
            deleteButton.removeAttribute('disabled');
        } else if (selectedCheckboxes.length > 0) {
            deleteButton.removeAttribute('disabled'); // Aktifkan tombol Hapus jika satu checkbox terpilih
        } else if (selectedCheckboxes.length === 0) {
            editButton.setAttribute('disabled', 'true');
            deleteButton.setAttribute('disabled', 'true'); // Nonaktifkan tombol Hapus jika tidak ada checkbox terpilih
        } else {
            editButton.setAttribute('disabled', 'true');
            deleteButton.setAttribute('disabled', 'true'); // Nonaktifkan tombol Hapus jika lebih dari satu checkbox terpilih
        }
    }

    function handleDeleteClick() {
        const selectedCheckboxes = document.querySelectorAll('.sub_chk:checked');
        const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.getAttribute('data-id'));

        if (selectedIds.length > 0) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data yang dipilih?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lakukan penghapusan data dengan AJAX
                    $.ajax({
                        url: '{{ url('
                        delete - user ') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: selectedIds, // Kirim array ID yang akan dihapus
                            _method: 'DELETE' // Tambahkan _method dengan nilai 'DELETE' untuk metode DELETE
                        },
                        success: function(response) {
                            console.log(response);

                            Swal.fire({
                                icon: 'success',
                                title: 'Data berhasil dihapus!',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            setTimeout(function() {
                                window.location.href = '{{ url('
                                user ') }}';
                            }, 2000);
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan!',
                                text: 'Data tidak dapat dihapus.'
                            });
                        }
                    });
                }
            });
        }
    }

    // JavaScript to open the modal and populate data for editing
    function handleEditClick() {
        const selectedCheckboxes = document.querySelectorAll('.sub_chk:checked');
        const editModal = document.querySelector('#editModal');
        const editForm = document.querySelector('#editForm');

        if (selectedCheckboxes.length === 1) {
            const selectedId = selectedCheckboxes[0].getAttribute('data-id');
            const name = document.querySelector(`#tr_${selectedId} td:nth-child(3)`).textContent;
            const email = document.querySelector(`#tr_${selectedId} td:nth-child(4)`).textContent;
            const chain = document.querySelector(`#tr_${selectedId} td:nth-child(5)`).textContent;
            const role = document.querySelector(`#tr_${selectedId} td:nth-child(6)`).textContent;

            document.querySelector('#editName').value = name;
            document.querySelector('#editEmail').value = email;
            document.querySelector('#editChain').value = chain;
            document.querySelector('#editRole').value = role;

            $(editModal).modal('show');
        }
    }

    function saveChanges() {
        const name = document.querySelector('#editName').value;
        const email = document.querySelector('#editEmail').value;
        const chain = document.querySelector('#editChain').value;
        const role = document.querySelector('#editRole').value;
        const selectedCheckboxes = document.querySelectorAll('.sub_chk:checked');

        if (selectedCheckboxes.length === 1) {
            const selectedId = selectedCheckboxes[0].getAttribute('data-id');

            $.ajax({
                url: '{{ url('
                update - user ') }}/' + selectedId,
                method: 'POST',
                data: {
                    name: name,
                    email: email,
                    chain: chain,
                    role: role,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    console.log(response);

                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil diperbarui!',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    setTimeout(function() {
                        window.location.href = '{{ url('
                        user ') }}';
                    }, 2000);
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan!',
                        text: 'Data tidak dapat diperbarui.'
                    });
                }
            });
        }
    }
</script>

@endsection