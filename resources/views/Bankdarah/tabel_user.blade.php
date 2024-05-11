<table id="tb_user" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Nama</th>
        <th>Username</th>
        <th>Unit</th>
        <th>Hak Akses</th>
        <th>Status</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($datauser as $d)
            <tr>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->username }}</td>
                <td>Bank Darah</td>
                <td>
                    @if ($d->hak_akses == 1)
                        Admin
                    @else
                        Super Admin
                    @endif
                </td>
                <td>
                    @if ($d->status == 0)
                        Tidak Aktif
                    @else
                        Aktif
                    @endif
                </td>
                <td><button class="btn btn-sm btn-primary edituserbtn" id="{{ $d->id }}" data-toggle="modal" data-target="#modaledituser"><i
                            class="bi bi-pencil-square"></i> Edit</button></td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="modaledituser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_form_edit_user">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="simpanedituser()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tb_user").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true
        })
    });
    $(".edituserbtn").on('click', function(event) {
        id = $(this).attr('id')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('formedituser') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_form_edit_user').html(response);
            }
        });
    })
    function simpanedituser()
    {
        Swal.fire({
              title: "Apakah anda yakin ?",
              text: "Data User akan diedit ...",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Ya, edit data"
          }).then((result) => {
              if (result.isConfirmed) {
                  var data1 = $('.form_edit_user').serializeArray();
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
                      url: '<?= route('simpanedituser') ?>',
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
                              ambildatauser()
                          }
                      }
                  });
              }
          });
    }
