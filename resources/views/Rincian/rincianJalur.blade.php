@extends('layout.main')

@section('jalur', 'nav-item active')

@section('content')

<style>
    div.dataTables_wrapper {
        width: auto;
        height: 300px;
        margin: 0 auto;
    }

    .tombol {
        font-family: sans-serif;
        font-size: 14px;
        background: #22a4cf;
        color: white;
        border: white 1px solid;
        border-radius: 4px;
        padding: 3px 6px;
    }

    button:hover,
    input[type=submit]:hover {
        opacity: 0.9;
    }

</style>

@if (auth()->user()->username == 'superviser')
<form action="" method="GET">
    @csrf
    <div class="row mb-3">
        <div class="col-md-4 pl-3 pr-2">
            <select data-placeholder="Filter Wilker..." class="standardSelect" name="nama_wilker" tabindex="1">
                @if (request('nama_wilker'))
                <option value="{{ request('nama_wilker') }}" label="default">{{ request('nama_wilker') }}</option>
                @else
                <option value="Semua Wilker" label="default">Semua Wilker</option>
                @endif
                <option value="Semua Wilker" label="default">Semua Wilker</option>
                @foreach ($nama_wilker as $item)
                <option value="{{ $item->lokasi }}">{{ $item->lokasi }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 pl-0 pr-2">
            <select data-placeholder="Filter Tahun..." class="standardSelect" name="tahun" tabindex="1">
                @if (request('tahun'))
                <option value="{{ request('tahun') }}" label="default">Tahun {{ request('tahun') }}</option>
                @else
                <option value="{{ $thn_skr = date('Y'); }}" label="default">Tahun {{ $thn_skr = date('Y'); }}</option>
                @endif
                {{ $thn_skr = date('Y'); }}
                @for ($x = $thn_skr; $x >= 2000; $x--) {
                <option value="{{ $x }}">Tahun {{ $x }}</option>
                }
                @endfor
            </select>
        </div>
        <div class="col-md-1 pl-0">
            <button type="submit" class="btn btn-sm btn-info text-center tombol"><i class="fa fa-filter"></i>
                Filter</button>
        </div>
    </div>
</form>
@else
<form action="" method="GET">
    @csrf
    <div class="row mb-3">
        <div class="col-md-2 pl-3 pr-2">
            <select data-placeholder="Filter Tahun..." class="standardSelect" name="tahun" tabindex="1">
                @if (request('tahun'))
                <option value="{{ request('tahun') }}" label="default">Tahun {{ request('tahun') }}</option>
                @else
                <option value="{{ $thn_skr = date('Y'); }}" label="default">Tahun {{ $thn_skr = date('Y'); }}</option>
                @endif
                {{ $thn_skr = date('Y'); }}
                @for ($x = $thn_skr; $x >= 2000; $x--) {
                <option value="{{ $x }}">Tahun {{ $x }}</option>
                }
                @endfor
            </select>
        </div>
        <div class="col-md-1 pl-0">
            <button type="submit" class="btn btn-sm btn-info text-center tombol"><i class="fa fa-filter"></i>
                Filter</button>
        </div>
    </div>
</form>
@endif

<div class="row">
    <div class="col-md-10">
        <section class="card">
            <div class="card-body text-dark"><strong>Frekuensi Domestik Masuk</strong></div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <div class="feed-box">
            <section class="card">
                <div class="card-header text-dark"><strong>Frekuensi Hewan</strong></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-domas-h" class="table table-sm table-striped table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th>Kota Asal</th>
                                    <th>Kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rincian_domas_h as $item)
                                <tr>
                                    <td>{{ $item->kota_asal }}</td>
                                    <td>{{ number_format($item->domas_hewan) }} Kegiatan</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </section>
        </div>
    </div>
    <div class="col-md-10">
        <div class="feed-box">
            <section class="card">
                <div class="card-header text-dark"><strong>Frekuensi Tumbuhan</strong></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-domas-t" class="table table-sm table-striped table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th>Kota Asal</th>
                                    <th>Kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rincian_domas_t as $item)
                                <tr>
                                    <td>{{ $item->kota_asal }}</td>
                                    <td>{{ number_format($item->domas_tumbuhan) }} Kegiatan</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <section class="card">
            <div class="card-body text-dark"><strong>Frekuensi Domestik Keluar</strong></div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <div class="feed-box">
            <section class="card">
                <div class="card-header text-dark"><strong>Frekuensi Hewan</strong></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-dokel-h" class="table table-sm table-striped table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th>Kota Tujuan</th>
                                    <th>Kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rincian_dokel_h as $item)
                                <tr>
                                    <td>{{ $item->kota_tujuan }}</td>
                                    <td>{{ number_format($item->dokel_hewan) }} Kegiatan</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </section>
        </div>
    </div>
    <div class="col-md-10">
        <div class="feed-box">
            <section class="card">
                <div class="card-header text-dark"><strong>Frekuensi Tumbuhan</strong></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-dokel-t" class="table table-sm table-striped table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th>Kota Tujuan</th>
                                    <th>Kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rincian_dokel_t as $item)
                                <tr>
                                    <td>{{ $item->kota_tujuan }}</td>
                                    <td>{{ number_format($item->dokel_tumbuhan) }} Kegiatan</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <section class="card">
            <div class="card-body text-dark"><strong>Frekuensi Impor</strong></div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <div class="feed-box">
            <section class="card">
                <div class="card-header text-dark"><strong>Frekuensi Hewan</strong></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-impor-h" class="table table-sm table-striped table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th>Negara Asal</th>
                                    <th>Kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rincian_impor_h as $item)
                                <tr>
                                    <td>{{ $item->asal }}</td>
                                    <td>{{ number_format($item->impor_hewan) }} Kegiatan</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </section>
        </div>
    </div>
    <div class="col-md-10">
        <div class="feed-box">
            <section class="card">
                <div class="card-header text-dark"><strong>Frekuensi Tumbuhan</strong></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-impor-t" class="table table-sm table-striped table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th>Negara Asal</th>
                                    <th>Kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rincian_impor_t as $item)
                                <tr>
                                    <td>{{ $item->asal }}</td>
                                    <td>{{ number_format($item->impor_tumbuhan) }} Kegiatan</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <section class="card">
            <div class="card-body text-dark"><strong>Frekuensi Ekspor</strong></div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <div class="feed-box">
            <section class="card">
                <div class="card-header text-dark"><strong>Frekuensi Hewan</strong></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-ekspor-h" class="table table-sm table-striped table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th>Negara Tujuan</th>
                                    <th>Kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rincian_ekspor_h as $item)
                                <tr>
                                    <td>{{ $item->tujuan }}</td>
                                    <td>{{ number_format($item->ekspor_hewan) }} Kegiatan</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </section>
        </div>
    </div>
    <div class="col-md-10">
        <div class="feed-box">
            <section class="card">
                <div class="card-header text-dark"><strong>Frekuensi Tumbuhan</strong></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-ekspor-t" class="table table-sm table-striped table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th>Negara Tujuan</th>
                                    <th>Kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rincian_ekspor_t as $item)
                                <tr>
                                    <td>{{ $item->tujuan }}</td>
                                    <td>{{ number_format($item->ekspor_tumbuhan) }} Kegiatan</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection

@section('table')
<script>
    $(document).ready(function () {
        $('#table-domas-h').DataTable({
            lengthMenu: [
                [7, 10, 20, 50, -1],
                [7, 10, 20, 50, "All"]
            ],
            order: [1, 'desc'],
            responsive: true,
            scrollY: true,
            scrollX: true,
        });
    });

    $(document).ready(function () {
        $('#table-domas-t').DataTable({
            lengthMenu: [
                [7, 10, 20, 50, -1],
                [7, 10, 20, 50, "All"]
            ],
            order: [1, 'desc'],
            responsive: true,
            scrollY: true,
            scrollX: true,
        });
    });

    $(document).ready(function () {
        $('#table-dokel-h').DataTable({
            lengthMenu: [
                [7, 10, 20, 50, -1],
                [7, 10, 20, 50, "All"]
            ],
            order: [1, 'desc'],
            responsive: true,
            scrollY: true,
            scrollX: true,
        });
    });

    $(document).ready(function () {
        $('#table-dokel-t').DataTable({
            lengthMenu: [
                [7, 10, 20, 50, -1],
                [7, 10, 20, 50, "All"]
            ],
            order: [1, 'desc'],
            responsive: true,
            scrollY: true,
            scrollX: true,
        });
    });

    $(document).ready(function () {
        $('#table-impor-h').DataTable({
            lengthMenu: [
                [7, 10, 20, 50, -1],
                [7, 10, 20, 50, "All"]
            ],
            order: [1, 'desc'],
            responsive: true,
            scrollY: true,
            scrollX: true,
        });
    });

    $(document).ready(function () {
        $('#table-impor-t').DataTable({
            lengthMenu: [
                [7, 10, 20, 50, -1],
                [7, 10, 20, 50, "All"]
            ],
            order: [1, 'desc'],
            responsive: true,
            scrollY: true,
            scrollX: true,
        });
    });

    $(document).ready(function () {
        $('#table-ekspor-h').DataTable({
            lengthMenu: [
                [7, 10, 20, 50, -1],
                [7, 10, 20, 50, "All"]
            ],
            order: [1, 'desc'],
            responsive: true,
            scrollY: true,
            scrollX: true,
        });
    });

    $(document).ready(function () {
        $('#table-ekspor-t').DataTable({
            lengthMenu: [
                [7, 10, 20, 50, -1],
                [7, 10, 20, 50, "All"]
            ],
            order: [1, 'desc'],
            responsive: true,
            scrollY: true,
            scrollX: true,
        });
    });

</script>
@endsection
