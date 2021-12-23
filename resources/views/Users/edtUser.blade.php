@extends('layout.main')

@section('user', 'active')

@section('content')

<div class="row">

    <div class="col-lg-9">
        @foreach ($wilker as $item)
        <div class="card">
            <div class="card-header">Edit Data {{ $item->lokasi }}</div>
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
                                value="{{ old('username',$item->username) }}">
                            @error('username')
                            <div class="invalid-feedback">
                                Username Wilker Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-actions form-group">
                        <button type="submit" class="btn btn-success btn-sm">Edit</button>
                        <a href="/user" class="btn btn-danger btn-sm">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
