<table class="table table-striped">
    <thead style="background-color: #263a74; color:white; position: sticky; top: 0;">
        <tr>
            <td colspan="0" rowspan="3" style="vertical-align: middle;">No</td>
            <td colspan="0" rowspan="3" style="vertical-align: middle;">Nama</td>
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