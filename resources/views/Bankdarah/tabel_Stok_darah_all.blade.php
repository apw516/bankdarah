  <div class="card mt-3">
      <div class="card-header bg-info">Tabel Stok Darah</div>
      <div class="card-body">
          <table id="tabelstoknya" class="table table-sm table-hover table-bordered">
              <thead>
                  <th>No</th>
                  <th>Tanggal Terima</th>
                  <th>Tanggal Entry</th>
                  <th>Nomor Kantong</th>
                  <th>Golongan Darah</th>
                  <th>Tanggal Expired</th>
                  <th>Status</th>
                  <th>===</th>
              </thead>
              <tbody>
                  @php $no = 1 @endphp
                  @foreach ($stok as $s)
                      <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $s->tgl_terima }}</td>
                          <td>{{ $s->tgl_entry }}</td>
                          <td>{{ $s->nomor_kantong }}</td>
                          <td>{{ $s->gol_dar }}</td>
                          <td>{{ $s->tgl_expired }}</td>
                          <td>
                              @if ($s->status == 1)
                                  Tersedia
                              @else
                                  Terpakai
                              @endif
                          </td>
                          <td>
                              <button @if ($s->status == 2) disabled @endif
                                  class="btn btn-sm btn-warning detailstok" id="{{ $s->id }}" data-toggle="modal"
                                  data-target="#modaldetatil"><i class="bi bi-pencil-square"></i>
                                  Edit</button>
                              <button @if ($s->status == 2) disabled @endif
                                  class="btn btn-sm btn-danger hapusstok" id="{{ $s->id }}"><i
                                      class="bi bi-trash3"></i> Hapus</button>
                          </td>
                      </tr>
                      @php $no++ @endphp
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modaldetatil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Detail Stok</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="v_detail_Stok">

                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="simpanedit()"
                      data-dismiss="modal">Simpan</button>
              </div>
          </div>
      </div>
  </div>

  <script>
      $(function() {
          $("#tabelstoknya").DataTable({
              "responsive": false,
              "lengthChange": false,
              "autoWidth": true,
              "pageLength": 8,
              "searching": true
          })
      });
      $(".detailstok").on('click', function(event) {
          id = $(this).attr('id')
          spinner = $('#loader')
          spinner.show();
          $.ajax({
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  id
              },
              url: '<?= route('detailstok') ?>',
              error: function(data) {
                  spinner.hide()
                  alert('error')
              },
              success: function(response) {
                  spinner.hide()
                  $('.v_detail_Stok').html(response);
              }
          });
      });
      $(".hapusstok").on('click', function(event) {
          id = $(this).attr('id')
          Swal.fire({
              title: "Apakah anda yakin ?",
              text: "Stok darah akan dihapus",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Ya,hapus stok"
          }).then((result) => {
              if (result.isConfirmed) {
                  spinner = $('#loader')
                  spinner.show();
                  $.ajax({
                      async: true,
                      type: 'post',
                      dataType: 'json',
                      data: {
                          _token: "{{ csrf_token() }}",
                          id
                      },
                      url: '<?= route('hapusstok') ?>',
                      error: function(data) {
                          spinner.hide()
                          Swal.fire({
                              icon: 'error',
                              title: 'Ooops....',
                              text: 'Sepertinya ada masalah......',
                              footer: ''
                          })
                      },
                      success: function(data) {
                          spinner.hide()
                          if (data.kode == 500) {
                              Swal.fire({
                                  icon: 'error',
                                  title: 'Oopss...',
                                  text: data.message,
                                  footer: ''
                              })
                          } else {
                              Swal.fire({
                                  icon: 'success',
                                  title: 'OK',
                                  text: data.message,
                                  footer: ''
                              })
                              ambilstok()
                          }
                      }
                  });
              }
          });
      });

      function simpanedit() {
          Swal.fire({
              title: "Apakah anda yakin ?",
              text: "Data stok akan diedit ...",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Ya, edit data"
          }).then((result) => {
              if (result.isConfirmed) {
                  var data1 = $('.form_edit_stok').serializeArray();
                  spinner = $('#loader')
                  spinner.show();
                  $.ajax({
                      async: true,
                      type: 'post',
                      dataType: 'json',
                      data: {
                          _token: "{{ csrf_token() }}",
                          data1: JSON.stringify(data1),
                      },
                      url: '<?= route('simpaneditstok') ?>',
                      error: function(data) {
                          spinner.hide()
                          Swal.fire({
                              icon: 'error',
                              title: 'Ooops....',
                              text: 'Sepertinya ada masalah......',
                              footer: ''
                          })
                      },
                      success: function(data) {
                          spinner.hide()
                          if (data.kode == 500) {
                              Swal.fire({
                                  icon: 'error',
                                  title: 'Oopss...',
                                  text: data.message,
                                  footer: ''
                              })
                          } else {
                              Swal.fire({
                                  icon: 'success',
                                  title: 'OK',
                                  text: data.message,
                                  footer: ''
                              })
                              ambilstok()
                          }
                      }
                  });
              }
          });


      }
  </script>
