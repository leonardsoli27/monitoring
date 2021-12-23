@extends('layout.main')

@section('content')

<div class="row">

    <div class="col-lg-9">
        @foreach ($profil as $item)
        <div class="card">
            <div class="card-header"><strong>Profil {{ $item->lokasi }}</strong></div>
            <div class="card-body card-block">
                <form action="/user/edit/{{ $item->id_user }}" method="POST">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id_user }}">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-globe"></i></span>
                            <input type="text" class="form-control @error('lokasi')
                                is-invalid
                            @enderror" name="lokasi" placeholder="Lokasi Wilker"
                                value="{{ old('lokasi', $item->lokasi) }}">
                            @error('lokasi')
                            <div class="invalid-feedback">
                                Lokasi Wilker Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-md"></i></span>
                            <input type="text" class="form-control @error('admin_wilker')
                                is-invalid
                            @enderror" name="admin_wilker" placeholder="Admin Wilker"
                                value="{{ old('admin_wilker',$item->admin_wilker) }}">
                            @error('admin_wilker')
                            <div class="invalid-feedback">
                                Admin Wilker Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                            <input type="email" class="form-control @error('email')
                                is-invalid
                            @enderror" name="email" placeholder="Email Wilker" value="{{ old('email',$item->email) }}">
                            @error('email')
                            <div class="invalid-feedback">
                                Email Wilker Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control @error('username')
                                is-invalid
                            @enderror" name="username" placeholder="Username Wilker"
                                value="{{ old('username',$item->username) }}" readonly>
                            @error('username')
                            <div class="invalid-feedback">
                                Username Wilker Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-actions form-group">
                        <button type="submit" class="btn btn-success btn-sm">Edit Profil</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <strong>Ganti Password</strong>
            </div>
            <div class="card-body card-block">
                <form action="/user/profil/{{ auth()->user()->id_user }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-md">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mybutton" onclick="change()">
                                        <i class="menu-icon fa fa-eye-slash"></i>
                                    </span>
                                </div>
                                <input type="password" name="old_password" id="old_password"
                                    class="form-control @error('old_password') is-invalid @enderror"
                                    placeholder="Password Lama">
                                <div class="invalid-feedback">
                                    Password Tidak Sesuai
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mybutton2" onclick="change2()">
                                        <i class="menu-icon fa fa-eye-slash"></i>
                                    </span>
                                </div>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password Baru">
                                <div class="invalid-feedback">
                                    Password Min 5 Karakter
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mybutton4" onclick="change4()">
                                        <i class="menu-icon fa fa-eye-slash"></i>
                                    </span>
                                </div>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Konformasi Password">
                                <div class="invalid-feedback">
                                    Password Konfirmasi Tidak Sesuai
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions form-group">
                        <button type="submit" class="btn btn-success btn-sm">Ganti Password</button>
                        <a href="/" class="btn btn-danger btn-sm">Kembali</a>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('password')
<script type="text/javascript">
    function change() {
        var x = document.getElementById('old_password').type;

        if (x == 'password') {
            document.getElementById('old_password').type = 'text';
            document.getElementById('mybutton').innerHTML = '<i class="menu-icon fa fa-eye"></i>';
        } else {
            document.getElementById('old_password').type = 'password';
            document.getElementById('mybutton').innerHTML = '<i class="menu-icon fa fa-eye-slash"></i>';
        }
    }

    function change2() {
        var x = document.getElementById('password').type;

        if (x == 'password') {
            document.getElementById('password').type = 'text';
            document.getElementById('mybutton2').innerHTML = '<i class="menu-icon fa fa-eye"></i>';
        } else {
            document.getElementById('password').type = 'password';
            document.getElementById('mybutton2').innerHTML = '<i class="menu-icon fa fa-eye-slash"></i>';
        }
    }

    function change4() {
        var x = document.getElementById('password_confirmation').type;

        if (x == 'password') {
            document.getElementById('password_confirmation').type = 'text';
            document.getElementById('mybutton4').innerHTML = '<i class="menu-icon fa fa-eye"></i>';
        } else {
            document.getElementById('password_confirmation').type = 'password';
            document.getElementById('mybutton4').innerHTML = '<i class="menu-icon fa fa-eye-slash"></i>';
        }
    }

</script>
@endsection
