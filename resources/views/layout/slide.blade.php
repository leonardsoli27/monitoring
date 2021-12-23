<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="@yield('dashboard')">
                    <a href="{{ url('/dashboard') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard</a>
                </li>
                @if (auth()->user()->username == 'superviser')
                <li class="menu-title">Daftar Wilker</li><!-- /.menu-title -->
                <li class="@yield('user')">
                    <a href="{{ url('/user') }}"> <i class="menu-icon fa fa-users"></i>Akun Wilker</a>
                </li>
                @endif
                <li class="menu-title">Frekuensi Komoditas</li><!-- /.menu-title -->
                <li class="@yield('rHewan')">
                    <a href="{{ url('/rHewan') }}"> <i class="menu-icon fa fa-paw"></i>Komoditas Hewan</a>
                </li>
                <li class="@yield('rTumbuhan')">
                    <a href="{{ url('/rTumbuhan') }}"> <i class="menu-icon fa fa-pagelines"></i>Komoditas Tumbuhan</a>
                </li>
                <li class="@yield('jalur')">
                    <a href="{{ url('/jalur') }}"> <i class="menu-icon fa fa-road"></i>Jalur Komoditas</a>
                </li>
                <li class="menu-title">Data Komoditas</li><!-- /.menu-title -->
                @if (auth()->user()->username != 'superviser')
                <li class="@yield('lalulintas')">
                    <a href="{{ url('/lalulintas') }}"> <i class="menu-icon fa fa-folder-open"></i>Tambah Data</a>
                </li>
                @endif
                <li class="menu-item-has-children dropdown @yield('domas')">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="menu-icon fa fa-download"></i>Domestik Masuk</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-paw"></i><a href="{{ url('/domasHewan') }}">Hewan</a></li>
                        <li><i class="fa fa-pagelines"></i><a href="{{ url('/domasTumbuhan') }}">Tumbuhan</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown @yield('dokel')">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-upload"></i>Domestik Keluar</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-paw"></i><a href="{{ url('/dokelHewan') }}">Hewan</a></li>
                        <li><i class="fa fa-pagelines"></i><a href="{{ url('/dokelTumbuhan') }}">Tumbuhan</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown @yield('impor')">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="menu-icon fa fa-sign-in"></i>Impor</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-paw"></i><a href="{{ url('/imporHewan') }}">Hewan</a></li>
                        <li><i class="fa fa-pagelines"></i><a href="{{ url('/imporTumbuhan') }}">Tumbuhan</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown @yield('ekspor')">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-sign-out"></i>Ekspor</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-paw"></i><a href="{{ url('/eksporHewan') }}">Hewan</a></li>
                        <li><i class="fa fa-pagelines"></i><a href="{{ url('/eksporTumbuhan') }}">Tumbuhan</a></li>
                    </ul>
                </li>
                <li class="menu-title">Laporan</li><!-- /.menu-title -->
                <li class="@yield('laporan') mb-4">
                    <a href="{{ url('/laporan') }}"><i class="menu-icon ti-clipboard"></i>Cetak Laporan</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
