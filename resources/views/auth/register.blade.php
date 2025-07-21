@extends('layouts.app')
@section('judul')
Karangduren Archive
@endsection
@section('judul_sub')
Form Daftar Akun
@endsection
@section('content')

<body>
    <div>
        <div class="container" style="width: 500px">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="p-2">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4 mt-4">Daftar Akun</h1>
                                </div>
                                <form class="user" style="width:300px; margin-right:50px" method="POST"
                                    action="{{ url('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control form-control-user"
                                            id="exampleInputname" placeholder="Masukan Nama Lengkap"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    </div>
                                    @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                    @error('role')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror

                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            id="exampleInputEmail" placeholder="Masukan Email Address"
                                            value="{{ old('email') }}" name="email">
                                    </div>
                                    @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    @error('password')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                    <div class="form-group">
                                        <input type="password" name="password_repeat"
                                            class="form-control form-control-user" id="exampleRepeatPassword"
                                            placeholder="Repeat Password">
                                    </div>
                                    @error('password')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Daftar Akun
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('password.request') }}">Lupa Password?</a>
                                </div>
                                <div class="text-center mb-4">
                                    <a class="small" href="{{ url('login') }}">Saya Punya Akun? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Registrasi Berhasil',
            text: '{{ session('success') }}',
        });
    </script>
@endif

</body>

@endsection