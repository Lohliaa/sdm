@extends('layouts.master')
@section('judul')
@endsection
@section('judul_sub')
EDIT AKUN
@endsection
@section('content')

<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h4 class="font-weight-bold text-primary mb-0">EDIT AKUN GURU PEGAWAI SIT PERMATA</h4>
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
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Password <small>(kosongkan jika tidak ingin mengubah)</small></label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="password">
                            <span class="input-group-text" onclick="togglePassword('password', this)" style="cursor: pointer;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" name="chain" class="form-control" id="chain">
                            <span class="input-group-text" onclick="togglePassword('chain', this)" style="cursor: pointer;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <option value="" disabled>-- Pilih Role --</option>
                            <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Staff" {{ old('role', $user->role) == 'Staff' ? 'selected' : '' }}>Staff</option>
                            <option value="Guru" {{ old('role', $user->role) == 'Guru' ? 'selected' : '' }}>Guru</option>
                        </select>
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-warning">Update Data</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script>
    function togglePassword(fieldId, iconElement) {
        const input = document.getElementById(fieldId);
        const icon = iconElement.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
<script>
    // Toggle password visibility
    function togglePassword(id, icon) {
        const input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
            icon.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            input.type = "password";
            icon.innerHTML = '<i class="fas fa-eye"></i>';
        }
    }

    // Auto-fill chain = password
    document.getElementById('password').addEventListener('input', function () {
        document.getElementById('chain').value = this.value;
    });
</script>

@endsection