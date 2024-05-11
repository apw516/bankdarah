<label for="" class="text-bold">Nomor : {{ $header[0]->kode_pemakaian_header }}</label><br>
Jumlah Labu : {{ $header[0]->jumlah_labu }}
<table class="table table-sm table-bordered mt-3" id="tabel_detail_pemakaian_darah">
    <thead>
        <th>Nomor Kantong</th>
        <th>Golongan Darah</th>
        <th>Tgl entry</th>
        <th>Tgl expired</th>
        <th>===</th>
    </thead>
    <tbody>
        @foreach ($detail as $d)
            <tr>
                <td>{{ $d->nomor_kantong }}</td>
                <td>{{ $d->jenis_goldar }}</td>
                <td>{{ $d->tgl_entry }}</td>
                <td>{{ $d->tgl_expired }}</td>
                <td><button class="btn btn-sm btn-danger retursatu" id="{{ $d->id }}"><i class="bi bi-trash3"></i> </button></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabel_detail_pemakaian_darah").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true
        })
    });
    $(".retursatu").on('click', function(event) {
        id = $(this).attr('id')
        Swal.fire({
            title: "Apakah anda yakin ?",
            text: "Satu Pemakaian darah akan dibatalkan",
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
                    url: '<?= route('returpemakaian') ?>',
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
                            $('#detailpemakaian').modal('hide');
                            tampildatapemakaian()
                        }
                    }
                });
            }
        });
    })
</script>
