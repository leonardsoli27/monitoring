@extends('layout.main')

@section('laporan', 'nav-item active')

@section('content')

<style>
    div.dataTables_wrapper {
        width: 910px;
        margin: 0 auto;
    }

</style>

@if ( auth()->user()->username == 'superviser')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Laporan Lalu Lintas Komoditas</strong>
            </div>
            <div class="card-body">
                <form action="/laporan" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="basic-addon1">Dari</span>
                                <input type="date" class="form-control form-control-sm @error('dari')
                                    is-invalid
                                @enderror" name="dari" placeholder="Dari Tanggal">
                                @error('dari')
                                <div class="invalid-feedback">
                                    Tanggal Wajib Diisi.
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="basic-addon1">Sampai</span>
                                <input type="date" class="form-control form-control-sm @error('sampai')
                                    is-invalid
                                @enderror" name="sampai" placeholder="Sampai Tanggal">
                                @error('sampai')
                                <div class="invalid-feedback">
                                    Tanggal Wajib Diisi.
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-3">
                            <select data-placeholder="Asal Wilker..." class="standardSelect @error('asal_wilker')
                            is-invalid @enderror" name="asal_wilker" tabindex="1">
                                <option value="" label="default"></option>
                                <option value="Semua">Semua</option>
                                @foreach ($wilker as $item)
                                <option value="{{ $item->lokasi }}">{{ $item->lokasi }}</option>
                                @endforeach
                            </select>
                            @error('asal_wilker')
                            <div class="invalid-feedback">
                                Wilker Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-3">
                            <select data-placeholder="Jalur Komoditas" class="standardSelect @error('jalur_komoditas')
                            is-invalid @enderror" name="jalur_komoditas" tabindex="1">
                                <option value="" label="default"></option>
                                <option value="Semua">Semua</option>
                                <option value="DOMAS" label="default">DOMAS</option>
                                <option value="DOKEL" label="default">DOKEL</option>
                                <option value="IMPOR" label="default">IMPOR</option>
                                <option value="EKSPOR" label="default">EKSPOR</option>
                            </select>
                            @error('jalur_komoditas')
                            <div class="invalid-feedback">
                                Jalur Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg mb-3">
                            <select data-placeholder="Jenis Komoditas..." class="standardSelect @error('jenis_komoditas')
                            is-invalid @enderror" name="jenis_komoditas" tabindex="1">
                                <option value="" label="default"></option>
                                <option value="Hewan">Hewan</option>
                                <option value="Tumbuhan">Tumbuhan</option>
                            </select>
                            @error('jenis_komoditas')
                            <div class="invalid-feedback">
                                Jenis Komoditas Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-print"></i>
                                Cetak Laporan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@if (auth()->user()->username != 'superviser')

<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Laporan Lalu Lintas Komoditas</strong>
            </div>
            <div class="card-body">
                <form action="/laporan" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="basic-addon1">Dari</span>
                                <input type="date" class="form-control form-control-sm @error('dari')
                                    is-invalid
                                @enderror" name="dari" placeholder="Dari Tanggal">
                                @error('dari')
                                <div class="invalid-feedback">
                                    Tanggal Wajib Diisi.
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="basic-addon1">Sampai</span>
                                <input type="date" class="form-control form-control-sm @error('sampai')
                                    is-invalid
                                @enderror" name="sampai" placeholder="Sampai Tanggal">
                                @error('sampai')
                                <div class="invalid-feedback">
                                    Tanggal Wajib Diisi.
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-3">
                            <select data-placeholder="Jalur Komoditas" class="standardSelect @error('jalur_komoditas')
                            is-invalid @enderror" name="jalur_komoditas" tabindex="1">
                                <option value="" label="default"></option>
                                <option value="Semua">Semua</option>
                                <option value="DOMAS" label="default">DOMAS</option>
                                <option value="DOKEL" label="default">DOKEL</option>
                                <option value="IMPOR" label="default">IMPOR</option>
                                <option value="EKSPOR" label="default">EKSPOR</option>
                            </select>
                            @error('jalur_komoditas')
                            <div class="invalid-feedback">
                                Jalur Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg mb-3">
                            <select data-placeholder="Jenis Komoditas..." class="standardSelect @error('jenis_komoditas')
                            is-invalid @enderror" name="jenis_komoditas" tabindex="1">
                                <option value="" label="default"></option>
                                <option value="Hewan">Hewan</option>
                                <option value="Tumbuhan">Tumbuhan</option>
                            </select>
                            @error('jenis_komoditas')
                            <div class="invalid-feedback">
                                Jenis Komoditas Wajib Diisi.
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-print"></i>
                                Cetak Laporan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endif

@endsection
