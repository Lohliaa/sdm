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
                                {{--  <button onclick="exportData()" type="button" class="btn btn-info mr-2">
                                    <i class="bi bi-download"></i>
                                </button>  --}}
                                <button type="button" class="btn btn-warning mr-2" data-bs-toggle="modal"
                                    data-bs-target="#viewModal" data-id="{{ $h->id }}"
                                    data-nomor="{{ $h->nomor_surat }}" data-kategori="{{ $h->kategori }}"
                                    data-judul="{{ $h->judul }}" data-waktu="{{ $h->updated_at }}"
                                    data-file="{{ $h->file_path }}">
                                    <i class="bi bi-eye"></i>
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