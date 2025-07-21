@extends('layouts.app')
@section('judul')
Karangduren Archive
@endsection
@section('judul_sub')
Form Reset
@endsection
@section('content')
<body>
    <div>
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-6 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-10"></div>
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                                        </div>
                                        <form class="user" method="POST" action="{{ route('forget.password.get') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control form-control-user"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Masukan Email Address...">
                                            </div>
                                            @error('email')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                       
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Send Reset Password Link
                                            </button>
                                        </form>
                                        <hr>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="{{ route('login') }}">Sudah Punya Akun?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="{{ url('register') }}">Daftar Akun!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    </html>
</body>
@endsection
