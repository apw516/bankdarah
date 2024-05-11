@extends('Templates.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Stok Darah</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Stok Darah</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <button class="btn btn-success" data-toggle="modal" data-target="#modaladdstok"><i
                    class="bi bi-patch-plus mr-1"></i> Stok Darah</button>
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
                            <button class="btn btn-info" style="margin-top:32px" onclick="ambilstok()"><i class="bi bi-search mr-2"></i>Tampil</button>
                        </div>
                    </div>
            <div class="v_stok_darah">

            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modaladdstok" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah stok darah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-success btn-sm addkantong" onclick="addform()"><i class="bi bi-plus mr-2"></i>
                        Add Kantong</button>
                    <form action="" method="post" class="arrraykantong mt-3">
                        <div class="formkantongdarah" id="formkantong">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpanstok()" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".preloader2").fadeOut();
        $(document).ready(function() {
            ambilstok()
        })

        function ambilstok() {
            spinner = $('#loader')
            spinner.show();
            awal = $('#tanggalawal').val()
            akhir = $('#tanggalakhir').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",awal,akhir
                },
                url: '<?= route('ambilstokdarah') ?>',
                error: function(data) {
                    spinner.hide()
                    alert('error')
                },
                success: function(response) {
                    spinner.hide()
                    $('.v_stok_darah').html(response);
                }
            });
        }

        function addform() {
            var max_fields = 10;
            var wrapper = $(".formkantongdarah"); //Fields wrapper
            var x = 1
            if (x < max_fields) { //max input box allowed
                $(wrapper).append(
                    '<div class="form-row text-xs"><div class="form-group col-md-2"><label for="">Nomor Kantong</label><input type="" class="form-control form-control-sm text-xs" id="" name="nomorkantong" value=""></div><div class="form-group col-md-2"><label for="inputPassword4">Golongan darah</label><select class="form-control-sm form-control" id="goldar" name="goldar"><option value="A">A</option><option value="B">B</option><option value="AB">AB</option><option value="O">O</option></select></div><div class="form-group col-md-3"><label for="inputPassword4">Tanggal expired</label><input type="date" class="form-control form-control-sm" id="" name="tglexp"></div><div class="form-group col-md-3"><label for="inputPassword4">Tanggal terima</label><input type="date" class="form-control form-control-sm" id="" name="tglterima"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger"></i></div>'
                );
                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            }
        }

        function simpanstok() {
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
                url: '<?= route('simpanstokdarah') ?>',
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
                        document.getElementById('formkantong').innerHTML = "";
                    }
                }
            });
        }
    </script>
@endsection
