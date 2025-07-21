@extends('layouts.master')
@section('judul')
{{-- Aplikasi | Project 2 Laravel JCC --}}
@endsection
@section('judul_sub')
About
@endsection
@section('content')

<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary">About</h6>
        </div>
        <div id="filtered-data-container">
            <div class="card-body pt-0">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center">
                        <!-- Photo Section -->
                        <img src="{{ asset('img/images/2041720214.jpeg') }}" style="width: 50%; height: 90%; "
                            class="profile-img mb-3 mt-3" alt="Foto">
                    </div>
                    <div class="col-md-8">
                        <!-- Information Table -->
                        <table class="table table-borderless">
                            <tr>
                                <th> Aplikasi ini dibuat oleh:</th>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>Lia Puspita Dewi</td>
                            </tr>
                            <tr>
                                <th>Program Studi</th>
                                <td>D4 Teknik Informatika</td>
                            </tr>
                            <tr>
                                <th>NIM</th>
                                <td>2041720214</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pembuatan Aplikasi</th>
                                <td>09 Juli 2024</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection