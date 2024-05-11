<form class="form_edit_stok">
    <div class="form-group">
      <label for="exampleInputEmail1">Nomor Kantong</label>
      <input type="email" class="form-control" id="nomorkantong_d" name="nomorkantong_d" aria-describedby="emailHelp" value="{{ $detail[0]->nomor_kantong}}">
      <input hidden type="email" class="form-control" id="id_S" name="id_S" aria-describedby="emailHelp" value="{{ $detail[0]->id}}">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Golongan Darah</label>
      <select class="form-control" id="jenisgoldar_d" name="jenisgoldar_d">
        <option value="A" @if($detail[0]->gol_dar == 'A') selected @endif>A</option>
        <option value="B" @if($detail[0]->gol_dar == 'B') selected @endif>B</option>
        <option value="AB" @if($detail[0]->gol_dar == 'AB') selected @endif>AB</option>
        <option value="O" @if($detail[0]->gol_dar == 'O') selected @endif>O</option>
      </select>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Tanggal Expired</label>
      <input type="date" class="form-control" id="tglexp_d" name="tglexp_d" value="{{ $detail[0]->tgl_expired}}">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Tanggal Terima</label>
      <input type="date" class="form-control" id="tglterima_d" name="tglterima_d" value="{{ $detail[0]->tgl_terima}}">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Status</label>
      <select class="form-control" id="status_d" name="status_d">
        <option @if($detail[0]->status == '1') selected @endif value="1">Tersedia</option>
        <option @if($detail[0]->status == '2') selected @endif value="2">Terpakai</option>
      </select>
    </div>
  </form>
