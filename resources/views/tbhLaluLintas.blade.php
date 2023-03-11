@extends('layout.main')

@section('lalulintas', 'active')

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Tambah Data Hewan</strong>
            </div>
            <div class="card-body">
                <form action="/lalulintas/hewan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-md"></i></span>
                                <input type="text" class="form-control" name=" admin_wilker"
                                    value="{{ auth()->user()->lokasi }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg">
                            <div class="input-group input-group-sm">
                                <input type="file" class="form-control @error('file_hewan') is-invalid
                                @enderror" name="file_hewan" id="file_hewan" aria-describedby="file_hewan"
                                    aria-label="Upload">
                                @error('file_hewan')
                                <div class="invalid-feedback">
                                    Wajib Diisi |Format file xls, xlsx.
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Tambah Data Tumbuhan</strong>
            </div>
            <div class="card-body">
                <form action="/lalulintas/tumbuhan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-md"></i></span>
                                <input type="text" class="form-control" name="admin_wilker" placeholder="Nama Komoditas"
                                    value="{{ auth()->user()->lokasi }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg">
                            <div class="input-group input-group-sm">
                                <input type="file" class="form-control @error('file_tumbuhan') is-invalid
                                @enderror" name="file_tumbuhan" id="file_tumbuhan" aria-describedby="file_tumbuhan"
                                    aria-label="Upload">
                                @error('file_tumbuhan')
                                <div class="invalid-feedback">
                                    Wajib Diisi |Format file xls, xlsx.
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
