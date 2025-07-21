<table class="table table-striped">
    <thead style="background-color: #263a74; color:white; position: sticky; top: 0;">
        <tr>
            <td colspan="0" rowspan="3" style="vertical-align: middle;"></td>
            <td colspan="0" rowspan="3" style="vertical-align: middle;">No</td>
            <td colspan="0" rowspan="3" style="vertical-align: middle;">Nama</td>
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
                    <i class="toggle-password-icon bi bi-eye-slash-fill" onclick="togglePasswordVisibility(this)"></i>
                </div>
            </td>
            <td>{{ $kb->role }}</td>
        </tr>
        @endforeach
    </tbody>
</table>