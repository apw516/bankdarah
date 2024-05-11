<table id="tb_pemakaian" class="table table-sm table-bordered table-hover">
    <thead>
        <th>No</th>
        <th>Kode Pemakaian</th>
        <th>Jumlah Labu</th>
        <th>Tanggal entry</th>
        <th>---</th>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($list as $l)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $l->kode_pemakaian_header }}</td>
                <td>{{ $l->jumlah_labu }}</td>
                <td>{{ $l->tgl_entry }}</td>
                <td>
                    <button class="btn btn-sm btn-info detailpakai" id="{{ $l->id }}" data-toggle="modal"
                        data-target="#detailpemakaian"><i class="bi bi-ticket-detailed mr-2"></i> Detail</button>
                    <button class="btn btn-sm btn-danger batalpakai" id="{{ $l->id }}"><i
                            class="bi bi-trash3 mr-2"></i> Batal</button>
                </td>
            </tr>
            @php $no++ @endphp
        @endforeach
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="detailpemakaian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail pemakaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_detail_pemakaian">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tb_pemakaian").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true
        })
    });
    $(".detailpakai").on('click', function(event) {
        id = $(this).attr('id')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('detailpemakaiandarah') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_detail_pemakaian').html(response);
            }
        });
    })
    $(".batalpakai").on('click', function(event) {
        id = $(this).attr('id')
        Swal.fire({
            title: "Apakah anda yakin ?",
            text: "Pemakaian darah akan dibatalkan",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id
                    },
                    url: '<?= route('batalpemakaian') ?>',
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
                            tampildatapemakaian()
                        }
                    }
                });
            }
        });
    })
</script>
