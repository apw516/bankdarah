@extends('Templates.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pemakaian Darah</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Pemakaian Darah</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <button class="btn btn-success" data-toggle="modal" data-target="#modalformpemakaian"
                onclick="ambilstokdarah_pemakaian()"><i class="bi bi-patch-plus"></i> Pemakaian Darah</button>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal awal</label>
                            <input type="date" class="form-control" id="tanggalawal" value="{{ $awal }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal akhir</label>
                            <input type="date" class="form-control" id="tanggalakhir" aria-describedby="emailHelp" value="{{ $akhir }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-info" style="margin-top:32px" onclick="tampildatapemakaian()"><i class="bi bi-search mr-2"></i>Tampil</button>
                    </div>
                </div>
            <div class="v_riwayat_pemakaian mt-3">

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Modal -->
    <div class="modal fade" id="modalformpemakaian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Pemakaian Darah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="v_stok_darah_pemakaian">

                    </div>
                    <div class="card">
                        <div class="card-header bg-warning">List Darah yang dipakai ...</div>
                        <div class="card-body">
                            <form action="" method="post" class="arrraykantong mt-3">
                                <div class="formkantongdarah" id="formkantong">

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpanpemakaiandarah()" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".preloader2").fadeOut();
        $(document).ready(function() {
            tampildatapemakaian()
        })
        function ambilstokdarah_pemakaian() {
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                url: '<?= route('ambilstokdarahpemakaian') ?>',
                error: function(response) {
                    spinner.hide()
                    alert('error')
                },
                success: function(response) {
                    spinner.hide()
                    $('.v_stok_darah_pemakaian').html(response);
                }
            });
        }

        function simpanpemakaiandarah() {
            var data1 = $('.arrraykantong').serializeArray();
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
                url: '<?= route('simpanpemakaiandarah') ?>',
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
                        ambilstokdarah_pemakaian()
                        tampildatapemakaian()
                        document.getElementById('formkantong').innerHTML = "";
                    }
                }
            });
        }
        function tampildatapemakaian()
        {
            awal = $('#tanggalawal').val()
            akhir = $('#tanggalakhir').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",awal,akhir
                },
                url: '<?= route('ambildatapemakaian') ?>',
                error: function(response) {
                    spinner.hide()
                    alert('error')
                },
                success: function(response) {
                    spinner.hide()
                    $('.v_riwayat_pemakaian').html(response);
                }
            });
        }
    </script>
@endsection
