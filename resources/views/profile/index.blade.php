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

                <a href="{{ url('profile') }}" class="btn btn-success mt-3" style="height: 40px;"><i
                        class="bi bi-arrow-clockwise" style="font-size: 20px;"></i></a>

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

                <!-- Tombol Hapus -->
                <button type="button" class="btn btn-danger mt-3" id="deleteButton" onclick="handleDeleteClick()"
                    disabled><i class="bi bi-trash3"></i></button>

                <!-- Tombol Edit -->
                {{--  <button type="button" class="btn btn-warning mt-3" id="editButton" onclick="handleEditClick()"
                    disabled>Edit</button>  --}}

                <!-- Modal Edit-->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form for editing data -->
                                <form id="editForm">
                                    <div class="form-group">
                                        <label for="editName">Name</label>
                                        <input type="text" class="form-control" id="editName" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="editEmail">Email</label>
                                        <input type="text" class="form-control" id="editEmail" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="editChain">Password</label>
                                        <input type="password" class="form-control" id="editChain" name="chain">

                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="saveChanges()">Save
                                    Changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal konfirmasi -->
                <div class="modal fade" id="disableFeatureModal" tabindex="-1"
                    aria-labelledby="disableFeatureModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="disableFeatureModalLabel">Nonaktifkan Fitur</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menonaktifkan fitur ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" id="confirmDisableButton">Ya, Nonaktifkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="input-group col-md-3 mr-4">
                <input type="text" name="search" style="height: 2.4rem; font-size: 12pt; margin-top: 0.10rem;"
                    id="searchp" class="form-control input-text" placeholder="Cari disini ..."
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-striped" id="pTableBody">
                    <thead style="background-color: #263a74; color:white; position: sticky; top: 0;">
                        <tr>
                            <td colspan="0" rowspan="3" style="vertical-align: middle;"><input type="checkbox"
                                    class="sub_chk" id="master"></td>
                            <td colspan="0" rowspan="3" style="vertical-align: middle;">No</td>
                            <td colspan="0" rowspan="3" style="vertical-align: middle;">Name</td>
                            <td colspan="0" rowspan="3" style="vertical-align: middle;">Email</td>
                            <td colspan="0" rowspan="3" style="vertical-align: middle;">Password</td>
                            <td colspan="0" rowspan="3" style="vertical-align: middle;">Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1 ?>
                        @foreach ($profile as $kb)
                        <tr id="tr_{{ $kb->id }}">
                            <td><input type="checkbox" class="sub_chk" data-id="{{$kb->id}}"
                                    onclick="handleCheckboxChange({{ $kb->id }})"></td>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
    function searchProfile() {
        const selected = document.getElementById('searchp').value;
    
        fetch(`{{ route('search.profile') }}?profile=${selected}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('pTableBody').innerHTML = data;
            });
    }

    // Menambahkan event listener untuk input pencarian
    document.getElementById('searchp').addEventListener('input', function() {
    searchProfile();
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
      } else if (selectedCheckboxes.length > 0){
          deleteButton.removeAttribute('disabled'); // Aktifkan tombol Hapus jika satu checkbox terpilih
      }else if (selectedCheckboxes.length === 0) {
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
                url: '{{ url('delete-profile') }}',
                method: 'POST',
                data: {
                  _token: '{{ csrf_token() }}',
                  ids: selectedIds, // Kirim array ID yang akan dihapus
                  _method: 'DELETE' // Tambahkan _method dengan nilai 'DELETE' untuk metode DELETE
                },
                success: function (response) {
                  console.log(response);
      
                  Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil dihapus!',
                    showConfirmButton: false,
                    timer: 1500
                  });
      
                  setTimeout(function () {
                    window.location.href = '{{ url('profile') }}';
                  }, 2000);
                },
                error: function (error) {
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
                url: '{{ url('update-profile') }}/' + selectedId,
                method: 'POST',
                data: {
                    name: name,
                    email: email,
                    chain: chain,
                    role: role,
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    console.log(response);
    
                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil diperbarui!',
                        showConfirmButton: false,
                        timer: 1500
                    });
    
                    setTimeout(function () {
                        window.location.href = '{{ url('profile') }}';
                    }, 2000);
                },
                error: function (error) {
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