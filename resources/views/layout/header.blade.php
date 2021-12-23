<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            {{-- logo karantina --}}
            <a class="navbar-brand" href="./"><img src="{{ asset('images/logo2.png') }}" alt=""></a>
            <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/logo2.png') }}" alt=""></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="form-text mr-2 mb-1"><b>{{ auth()->user()->lokasi }}</b></span>
                    <i class="fa fa-users"></i>
                </a>
                <div class="user-menu dropdown-menu">
                    <a class="nav-link dropdown-item" href="/user/profil/{{ auth()->user()->id_user }}"><i
                            class="fa fa-user"></i>My
                        Profile</a>
                    <button class="nav-link dropdown-item" data-bs-toggle="modal" data-bs-target="#logout"
                        type="button">
                        <i class="fa fa-power-off"></i>Logout</button>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Modal -->
<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Logout</strong></h5>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Ingin Keluar Dari Aplikasi?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-primary" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
