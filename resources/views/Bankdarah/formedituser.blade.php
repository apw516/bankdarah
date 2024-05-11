<form class="form_edit_user">
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Lengkap</label>
        <input type="email" class="form-control" id="nama" name="nama" aria-describedby="emailHelp"
            value="{{ $user[0]->nama }}">
        <input hidden type="email" class="form-control" id="id" name="id" aria-describedby="emailHelp"
            value="{{ $user[0]->id }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input type="email" class="form-control" id="username" name="username" aria-describedby="emailHelp"
            value="{{ $user[0]->username }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Hak akses</label>
        <select class="form-control" id="hakakses" name="hakakses">
            <option value="1" @if ($user[0]->hak_akses == 1) selected @endif>Admin</option>
            <option value="2" @if ($user[0]->hak_akses == 2) selected @endif>Super Admin</option>
        </select>

    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Status</label>
        <select class="form-control" id="status" name="status">
            <option value="1" @if ($user[0]->status == 1) selected @endif>Aktif</option>
            <option value="0" @if ($user[0]->status == 0) selected @endif>Tidak Aktif</option>
        </select>
    </div>
</form>
