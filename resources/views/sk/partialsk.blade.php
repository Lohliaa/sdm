<div id="filtered-data-container">
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-striped" id="skTableBody">
                <thead style="background-color: #263a74; color:white; position: sticky; top: 0;">
                    <tr>
                        <td style="vertical-align: middle;">No</td>
                        <td style="vertical-align: middle;">No SK</td>
                        <td style="vertical-align: middle;">No Tambahan</td>
                        <td style="vertical-align: middle;">Nama</td>
                        <td style="vertical-align: middle;">Gelar</td>
                        <td style="vertical-align: middle;">Tempat Lahir</td>
                        <td style="vertical-align: middle;">Tanggal Lahir</td>
                        <td style="vertical-align: middle;">NIPY</td>
                        <td style="vertical-align: middle;">Gol Ruang</td>
                        <td style="vertical-align: middle;">Status Kepegawaian</td>
                        <td style="vertical-align: middle;">Unit Kerja</td>
                        <td style="vertical-align: middle;">TMT</td>
                        <td style="vertical-align: middle;">Tanggal Mulai</td>
                        <td style="vertical-align: middle;">Berlaku</td>
                        <td style="vertical-align: middle;">Tanggal Akhir</td>
                        <td style="vertical-align: middle;">Tanggal Ditetapkan</td>
                        <td style="vertical-align: middle;">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    @foreach ($sk as $h)
                    <tr id="tr_{{ $h->id }}">
                        <td>{{ $no++ }}</td>
                        <td>{{ $h->no_sk }}</td>
                        <td>{{ $h->no_tambahan }}</td>
                        <td>{{ $h->nama }}</td>
                        <td>{{ $h->gelar }}</td>
                        <td>{{ $h->tempat_lahir }}</td>
                        <td>{{ $h->tanggal_lahir}}</td>
                        <td>{{ $h->nipy }}</td>
                        <td>{{ $h->gol_ruang }}</td>
                        <td>{{ $h->status_kepegawaian }}</td>
                        <td>{{ $h->unit_kerja }}</td>
                        <td>{{ $h->tmt }}</td>
                        <td>{{ $h->tanggal_mulai }}</td>
                        <td>{{ $h->berlaku }}</td>
                        <td>{{ $h->tanggal_akhir }}</td>
                        <td>{{ $h->tanggal_ditetapkan }}</td>
                        <td>
                            <div class="d-flex">
                                <form id="deleteForm_{{ $h->id }}" action="{{ route('sk.destroy', $h->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger mr-2" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-id="{{ $h->id }}">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                                <button type="button" class="btn btn-warning mr-2" data-bs-toggle="modal"
                                    data-bs-target="#viewModal" data-noSK="{{ $h->no_sk }}"
                                    data-skTambahan="{{ $h->no_tambahan }}"
                                    data-nama="{{ $h->nama }}" data-gelar="{{ $h->gelar }}"
                                    data-tempat_lahir="{{ $h->tempat_lahir }}" data-tanggal_lahir="{{ $h->tanggal_lahir }}"
                                    data-nipy="{{ $h->nipy }}" data-gol_ruang="{{ $h->gol_ruang }}"
                                    data-status_kepegawaian="{{ $h->status_kepegawaian }}" data-unit_kerja="{{ $h->unit_kerja }}"
                                    data-tmt="{{ $h->tmt }}" data-tanggal_mulai="{{ $h->tanggal_mulai }}"
                                    data-berlaku="{{ $h->berlaku }}" data-tanggal_akhir="{{ $h->tanggal_akhir }}"
                                    data-tanggal_ditetapkan="{{ $h->tanggal_ditetapkan }}"><i class="bi bi-eye"></i>
                                </button>
                                <a href="{{ route('sk.edit', $h->id) }}" class="btn btn-secondary mr-2">
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