@extends('Templates.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Bank Darah</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas bi bi-heart-pulse-fill"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Stok Darah A</span>
                            <span class="info-box-number">
                                @if(count($stok) > 0){{ $stok[0]->goldar_A }}@endif
                                <small>Labu</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas bi bi-heart-pulse-fill"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Stok Darah B</span>
                            <span class="info-box-number">
                                @if(count($stok) > 0){{ $stok[0]->goldar_B }}@endif
                                <small>Labu</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas bi bi-heart-pulse-fill"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Stok Darah AB</span>
                            <span class="info-box-number">
                                @if(count($stok) > 0){{ $stok[0]->goldar_AB }}@endif
                                <small>Labu</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas bi bi-heart-pulse-fill"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Stok Darah O</span>
                            <span class="info-box-number">
                                @if(count($stok) > 0){{ $stok[0]->goldar_O }}@endif
                                <small>Labu</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Monthly Recap Report</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fas fa-wrench"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a href="#" class="dropdown-item">Action</a>
                                        <a href="#" class="dropdown-item">Another action</a>
                                        <a href="#" class="dropdown-item">Something else here</a>
                                        <a class="dropdown-divider"></a>
                                        <a href="#" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-center">
                                        <strong>Grafik Pemakaian Darah</strong>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Pilih Golongan Darah</label>
                                        <select class="form-control" id="goldargrafik" onchange="ambilgrafik()">
                                            <option value="ALL">Semua Golongan Darah
                                            </option>
                                            <option value="A">Golongan Darah A
                                            </option>
                                            <option value="B">Golongan Darah B
                                            </option>
                                            <option value="AB">Golongan Darah AB
                                            </option>
                                            <option value="O">Golongan Darah O
                                            </option>
                                        </select>
                                    </div>
                                    </p>

                                    <div class="chart" id="vcart">

                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <p class="text-center">
                                        <strong>Data Pemakaian Darah By Golongan Darah</strong>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Pilih Bulan</label>
                                        <select class="form-control" id="bulanprogres" onchange="ambil_progres()">
                                            @foreach ($bulan as $b)
                                                <option value="{{ $b->kode }}"
                                                    @if ($b->kode == $now) selected @endif>{{ $b->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </p>
                                    <div class="v_progres">

                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./card-body -->
                        <div class="card-footer">

                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div><!--/. container-fluid -->
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(".preloader2").fadeOut();
        $(document).ready(function() {
            ambil_progres()
            ambilgrafik()
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                        'September', 'Oktober', 'November', 'Desember'
                    ],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 4,
                        backgroundColor: '#9BD0A5',
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })

        function ambilgrafik() {
            goldargrafik = $('#goldargrafik').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    goldargrafik
                },
                url: '<?= route('ambil_grafik') ?>',
                error: function(response) {
                    alert('error')
                },
                success: function(response) {
                    $('#vcart').html(response);
                }
            });
        }

        function ambil_progres() {
            bulan = $('#bulanprogres').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    bulan
                },
                url: '<?= route('ambil_progres_pemakaian_darah') ?>',
                error: function(response) {
                    alert('error')
                },
                success: function(response) {
                    $('.v_progres').html(response);
                }
            });
        }
    </script>
@endsection
