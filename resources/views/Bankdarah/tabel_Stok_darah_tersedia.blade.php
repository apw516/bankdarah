  <div class="card mt-3">
      <div class="card-header bg-info">Tabel Stok Darah</div>
      <div class="card-body">
          <table id="tabelstoknya" class="table table-sm table-hover table-bordered text-xs">
              <thead>
                  <th>No</th>
                  <th>Tanggal Terima</th>
                  <th>Nomor Kantong</th>
                  <th>Golongan Darah</th>
                  <th>Tanggal Expired</th>
              </thead>
              <tbody>
                  @php $no = 1 @endphp
                  @foreach ($stok as $s)
                      <tr class="pilihdarah" id="{{ $s->id }}" nomorkantong="{{ $s->nomor_kantong }}"
                          goldar="{{ $s->gol_dar }}" tgl_exp="{{ $s->tgl_expired }}">
                          <td>{{ $no }}</td>
                          <td>{{ $s->tgl_terima }}</td>
                          <td>{{ $s->nomor_kantong }}</td>
                          <td>{{ $s->gol_dar }}</td>
                          <td>{{ $s->tgl_expired }}</td>
                      </tr>
                      @php $no++ @endphp
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
  <script>
      $(function() {
          $("#tabelstoknya").DataTable({
              "responsive": false,
              "lengthChange": false,
              "autoWidth": true,
              "pageLength": 5,
              "searching": true
          })
      });
      $(".pilihdarah").on('click', function(event) {
          id = $(this).attr('id')
          noka = $(this).attr('nomorkantong')
          goldar = $(this).attr('goldar')
          tgl_exp = $(this).attr('tgl_exp')
          var max_fields = 10;
          var wrapper = $(".formkantongdarah"); //Fields wrapper
          var x = 1
          if (x < max_fields) { //max input box allowed
              $(wrapper).append(
                  '<div class="form-row text-xs"><div class="form-group col-md-2"><label for="">Nomor Kantong</label><input type="" class="form-control form-control-sm text-xs" id="" name="nomorkantong" value="'+noka+'"><input hidden type="" class="form-control form-control-sm text-xs" id="" name="idkantong" value="'+id+'"></div><div class="form-group col-md-2"><label for="inputPassword4">Golongan darah</label><input type="" class="form-control form-control-sm text-xs" id="" name="goldar" value="'+goldar+'"></div><div class="form-group col-md-3"><label for="inputPassword4">Tanggal Pemakaian</label><input type="date" class="form-control form-control-sm" id="" name="tglpakai" value=""></div><div class="form-group col-md-3"><label for="inputPassword4">Tanggal expired</label><input type="date" class="form-control form-control-sm" id="" name="tglexp" value="'+tgl_exp+'"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger"></i></div>'
              );
              $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                  e.preventDefault();
                  $(this).parent('div').remove();
                  x--;
              })
          }
      });
  </script>
