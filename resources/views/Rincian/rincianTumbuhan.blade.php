@extends('layout.main')

@section('rTumbuhan', 'nav-item active')

@section('content')

<style>
    div.dataTables_wrapper {
        width: 735px;
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
        <div class="col-md-4 pr-2">
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
        <div class="col-md-2 pr-2">
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

    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Frekuensi Bibit Tumbuhan</strong>
            </div>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table id="table-rincian-bt" class="table table-sm table-striped table-bordered display nowrap">
                        <thead>
                            <tr>
                                <th>Nama Tumbuhan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rincian_bt as $item)
                            <tr>
                                <td>{{ $item->nama_komoditas }}</td>
                                <td>{{ number_format($item->jml_tumbuhan) }} {{ $item->satuan_komoditas }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
    </div>

    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Frekuensi Hasil Tanaman Hidup <i>(HTH)</i></strong>
            </div>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table id="table-rincian-hth" class="table table-sm table-striped table-bordered display nowrap">
                        <thead>
                            <tr>
                                <th>Nama Tumbuhan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rincian_hth as $item)
                            <tr>
                                <td>{{ $item->nama_komoditas }}</td>
                                <td>{{ number_format($item->jml_tumbuhan) }} {{ $item->satuan_komoditas }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
    </div>

    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Frekuensi Hasil Tanaman Mati <i>(HTM)</i></strong>
            </div>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table id="table-rincian-htm" class="table table-sm table-striped table-bordered display nowrap">
                        <thead>
                            <tr>
                                <th>Nama Hewan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rincian_htm as $item)
                            <tr>
                                <td>{{ $item->nama_komoditas }}</td>
                                <td>{{ number_format($item->jml_tumbuhan) }} {{ $item->satuan_komoditas }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
    </div>

    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Frekuensi Benda Lainnya</i></strong>
            </div>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table id="table-rincian-bl" class="table table-sm table-striped table-bordered display nowrap">
                        <thead>
                            <tr>
                                <th>Nama Tumbuhan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rincian_bl as $item)
                            <tr>
                                <td>{{ $item->nama_komoditas }}</td>
                                <td>{{ number_format($item->jml_tumbuhan) }} {{ $item->satuan_komoditas }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
    </div>

</div>

@endsection

@section('table')
<script>
    $(document).ready(function () {
        $('#table-rincian-bt').DataTable({
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ],
            order: [1, 'desc'],
            responsive: true,
            scrollY: true,
            scrollX: true,
        });
    });

    $(document).ready(function () {
        $('#table-rincian-hth').DataTable({
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ],
            order: [1, 'desc'],
            responsive: true,
            scrollY: true,
            scrollX: true,
        });
    });

    $(document).ready(function () {
        $('#table-rincian-htm').DataTable({
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ],
            order: [1, 'desc'],
            responsive: true,
            scrollY: true,
            scrollX: true,
        });
    });

    $(document).ready(function () {
        $('#table-rincian-bl').DataTable({
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ],
            order: [1, 'desc'],
            responsive: true,
            scrollY: true,
            scrollX: true,
        });
    });

</script>
@endsection
