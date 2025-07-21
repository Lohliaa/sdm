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