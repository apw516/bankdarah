<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-teal elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link bg-teal">
        <img src="{{ asset('public/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('public/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ strtoupper(auth()->user()->nama) }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @if ($menu == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">Bank Darah</li>
                <li class="nav-item">
                    <a href="{{ route('datapemakaian') }}"
                        class="nav-link @if ($menu == 'datapemakaian') active @endif">
                        <i class="nav-icon far bi bi-clipboard2-data"></i>
                        <p class="text">Data Pemakaian Darah</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('datastokdarah') }}"
                        class="nav-link @if ($menu == 'datastokdarah') active @endif">
                        <i class="nav-icon far bi bi-clipboard2-data"></i>
                        <p class="text">Data Stok Darah</p>
                    </a>
                </li>
                @if(auth()->user()->hak_akses == 2)
                <li class="nav-header">Data User</li>
                <li class="nav-item">
                    <a href="{{ route('datauser') }}" class="nav-link @if($menu == 'datauser') active @endif">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p class="text">Data User</p>
                    </a>
                </li>
                @endif
                <li class="nav-header">Akun</li>
                <li class="nav-item">
                    <a href="{{ route('infoakun') }}" class="nav-link @if($menu == 'infoakun') active @endif">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p class="text">Info Akun</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="logout()">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<script>
    function logout() {
        Swal.fire({
            title: 'Logout',
            text: "Apakah anda ingin logout ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d5',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "<?= route('logout') ?>";
            }
        })
    }
</script>
