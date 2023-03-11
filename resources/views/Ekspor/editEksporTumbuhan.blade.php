@extends('layout.main')

@section('domas', 'nav-item active')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Edit Data Impor Tumbuhan</strong>
            </div>
            <div class="card-body">
                <form action="/imporTumbuhan/edit" method="POST">
                    @method('put')
                    @csrf
                    <div class="table-responsive">
                        <table id="table" class="table">
                            <thead>
                                <tr align="center">
                                    <th>Nama Komoditas</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($editImporTumbuhan as $item)
                                <tr>
                                    <td>
                                        <div class="mb-2 col-auto">
                                            <input type="hidden" name="id[]" value="{{ $item->id_komoditas_tumbuhan }}">
                                            <input type="text" class="form-control" name="nama_komoditas[]"
                                                id="nama_komoditas" value="{{ $item->nama_komoditas }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-2 col-auto">
                                            <input type="text" class="form-control" name="jumlah[]" id="jumlah"
                                                value="{{ number_format($item->jml_komoditas) }}" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-2 col-auto">
                                            <input type="text" class="form-control" name="satuan[]" id="satuan"
                                                value="{{ $item->satuan_komoditas }}">
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="/imporTumbuhan" class="btn btn-sm btn-danger">
                        <i class="menu-icon fa fa-chevron-circle-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-sm btn-warning"><i class="menu-icon fa fa-edit"></i> Edit
                        Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
