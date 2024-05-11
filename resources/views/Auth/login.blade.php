@extends('Auth.main')
@section('container')
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Bank Darah</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan Login</p>
                <div class="mb-4">
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button class="btn-close" data-bs-dismiss="alert" aria-label="close" type="button"></button>
                    </div>
                    @endif
                    @if(session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button class="btn-close" data-bs-dismiss="alert" aria-label="close" type="button"></button>
                    </div>
                    @endif
                </div>
                <form action="{{ route('login')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="username ..." name="username" id="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas bi bi-person-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Log In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-0  mt-3">
                    <a href="{{ route('registrasi')}}" class="text-center">Belum punya akun ? Register</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
