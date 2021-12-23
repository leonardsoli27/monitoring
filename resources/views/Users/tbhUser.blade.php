@extends('layout.main')

@section('user', 'active')

@section('content')

<div class="row">

    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Tambah Wilker</strong>
            </div>
            <div class="card-body card-block">
                <form action="/user/register" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-globe"></i></span>
                            <input type="text" class="form-control @error('lokasi')
                                is-invalid
                            @enderror" name="lokasi" placeholder="Lokasi Wilker" value="{{ old('lokasi') }}">
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
                                value="{{ old('admin_wilker') }}">
                            @error('admin_wilker')
                            <div class=" invalid-feedback">
                                Admin Wilker Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                            <input type="email" class="form-control @error('email')
                                is-invalid
                            @enderror" name="email" placeholder="Email Wilker" value="{{ old('email') }}">
                            @error('email')
                            <div class=" invalid-feedback">
                                Email Wilker Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control @error('username')
                                is-invalid
                            @enderror" name="username" placeholder="Username Wilker" value="{{ old('username') }}">
                            @error('username')
                            <div class=" invalid-feedback">
                                Username Wilker Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock-alt"></i></span>
                            <input type="password" class="form-control @error('password')
                                is-invalid
                            @enderror" name="password" placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">
                                Password Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-actions form-group">
                        <button type="submit" class="btn btn-success btn-sm">Tambah</button>
                        <a href="/user" class="btn btn-danger btn-sm">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
