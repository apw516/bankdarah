@extends('Templates.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Info Akun</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Info akun</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle"
                           src="{{ asset('public/adminlte/dist/img/user4-128x128.jpg') }}"
                           alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ auth()->user()->nama}}</h3>

                    <p class="text-muted text-center">{{ auth()->user()->username}}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Jenis akun</b> <a class="float-right text-dark">@if(auth()->user()->hak_akses == 1) Admin @else Super admin @endif</a>
                      </li>
                      <li class="list-group-item">
                        <b>Unit</b> <a class="float-right text-dark">Bank Darah</a>
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
        </div><!--/. container-fluid -->
    </section>
    <script>
        $(".preloader2").fadeOut();
    </script>
@endsection
