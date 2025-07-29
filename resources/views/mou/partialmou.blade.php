<div id="filtered-data-container">
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-striped" id="mouTableBody">
                <thead style="background-color: #263a74; color:white; position: sticky; top: 0;">
                    <tr>
                        <td style="vertical-align: middle;">No</td>
                        <td style="vertical-align: middle;">No SK</td>
                        <td style="vertical-align: middle;">No Tambahan</td>
                        <td style="vertical-align: middle;">Status Kepegawaian</td>
                        <td style="vertical-align: middle;">Status Detail</td>
                        <td style="vertical-align: middle;">Nama</td>
                        <td style="vertical-align: middle;">Gelar</td>
                        <td style="vertical-align: middle;">Hari Kerja</td>
                        <td style="vertical-align: middle;">Jam Kerja</td>
                        <td style="vertical-align: middle;">Alamat</td>
                        <td style="vertical-align: middle;">Hari MoU</td>
                        <td style="vertical-align: middle;">Tanggal MoU</td>
                        <td style="vertical-align: middle;">Tempat Lahir</td>
                        <td style="vertical-align: middle;">Tanggal Lahir</td>
                        <td style="vertical-align: middle;">Unit Kerja</td>
                        <td style="vertical-align: middle;">Gaji Pokok</td>
                        <td style="vertical-align: middle;">Tunjangan Jabatan</td>
                        <td style="vertical-align: middle;">Tunjangan Transport</td>
                        <td style="vertical-align: middle;">Tunjangan Kinerja</td>
                        <td style="vertical-align: middle;">Tunjangan Fungsional</td>
                        <td style="vertical-align: middle;">THP</td>
                        <td style="vertical-align: middle;">Terbilang</td>
                        <td style="vertical-align: middle;">Tanggal Mulai</td>
                        <td style="vertical-align: middle;">Berlaku (bulan)</td>
                        <td style="vertical-align: middle;">Tanggal Akhir</td>
                        <td style="vertical-align: middle;">Saksi 1</td>
                        <td style="vertical-align: middle;">Saksi 2</td>
                        <td style="vertical-align: middle;">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    @foreach ($mou as $h)
                    <tr id="tr_{{ $h->id }}">
                        <td>{{ $no++ }}</td>
                        <td>{{ $h->no_sk }}</td>
                        <td>{{ $h->no_tambahan }}</td>
                        <td>{{ $h->status_kepegawaian }}</td>
                        <td>{{ $h->status_detail }}</td>
                        <td>{{ $h->nama }}</td>
                        <td>{{ $h->gelar }}</td>
                        <td>{{ $h->hari_kerja }}</td>
                        <td>{{ $h->jam_kerja }}</td>
                        <td>{{ $h->alamat }}</td>
                        <td>{{ $h->hari }}</td>
                        <td>{{ $h->tgl_mou }}</td>
                        <td>{{ $h->tempat_lahir }}</td>
                        <td>{{ $h->tanggal_lahir }}</td>
                        <td>{{ $h->unit_kerja }}</td>
                        <td>{{ $h->gaji_pokok }}</td>
                        <td>{{ $h->tunjangan_jabatan }}</td>
                        <td>{{ $h->tunjangan_transport }}</td>
                        <td>{{ $h->tunjangan_kinerja }}</td>
                        <td>{{ $h->tunjangan_fungsional }}</td>
                        <td>{{ $h->thp }}</td>
                        <td>{{ $h->terbilang }}</td>
                        <td>{{ $h->tgl_mulai }}</td>
                        <td>{{ $h->berlaku }}</td>
                        <td>{{ $h->tanggal_akhir }}</td>
                        <td>{{ $h->saksi1 }}</td>
                        <td>{{ $h->saksi2 }}</td>
                        <td>
                            <div class="d-flex">
                                <form id="deleteForm_{{ $h->id }}" action="{{ route('mou.destroy', $h->id) }}"
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
                                    data-skTambahan="{{ $h->no_tambahan }}" data-kepegawaian="{{ $h->status_kepegawaian }}" data-detail="{{ $h->status_detail }}"
                                    data-nama="{{ $h->nama }}" data-gelar="{{ $h->gelar }}"
                                    data-hari_kerja="{{ $h->hari_kerja }}" data-jam_kerja="{{ $h->jam_kerja }}"
                                    data-alamat="{{ $h->alamat }}" data-hari="{{ $h->hari }}"
                                    data-tanggal_mou="{{ $h->tgl_mou }}" data-TTL="{{ $h->tanggal_lahir }}"
                                    data-unit="{{ $h->unit_kerja }}" data-gaji="{{ $h->gaji_pokok }}"
                                    data-TJabatan="{{ $h->tunjangan_jabatan }}" data-TTransport="{{ $h->tunjangan_transport }}"
                                    data-TKinerja="{{ $h->tunjangan_kinerja }}" data-TFungsional="{{ $h->tunjangan_fungsional }}"
                                    data-thp="{{ $h->thp }}" data-terbilang="{{ $h->terbilang }}"
                                    data-tgl_mulai="{{ $h->tgl_mulai }}" data-berlaku="{{ $h->berlaku }}"
                                    data-tanggal_akhir="{{ $h->tanggal_akhir }}" data-saksi1="{{ $h->saksi1 }}"
                                    data-saksi2="{{ $h->saksi2 }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <a href="{{ route('mou.edit', $h->id) }}" class="btn btn-secondary mr-2">
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