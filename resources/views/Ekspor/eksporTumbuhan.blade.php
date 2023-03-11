@extends('layout.main')

@section('ekspor', 'nav-item active')

@section('content')

<style>
    div.dataTables_wrapper {
        width: 1400px;
        margin: 0 auto;
    }

</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Daftar Eksport Tumbuhan</strong>
            </div>
            <div class="card-body">
                <div class="row pl-3">
                    <div class="col-lg">
                        <button type="button" disabled onclick="editEksporTumbuhan()" id="editEksporTumbuhan"
                            class="btn btn-sm btn-warning"><i class="menu-icon fa fa-edit"></i> Edit Data
                            Terpilih</button>
                        <button type="button" disabled id="hapusEksporTumbuhan" data-bs-toggle="modal"
                            data-bs-target="#hapusEksporTbh" class="btn btn-sm btn-danger">
                            <i class="menu-icon fa fa-trash-o"></i> Hapus
                            Data Terpilih</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <hr class="mb-4 ml-3 mr-3">
                    <table id="table-ekspor-t" class="table table-striped table-bordered display nowrap">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="head-cb"></th>
                                @if (auth()->user()->username == 'superviser')
                                <td>Nama Wilker</td>
                                @endif
                                <th>Tanggal</th>
                                <th>Negara Asal</th>
                                <th>Negara Tujuan</th>
                                <th>Jenis Komoditas</th>
                                <th>Nama Komoditas</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Nilai Komoditas</th>
                                <th>PNBP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eksportumbuhan as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" class="cb-body" value="{{ $item->id_komoditas_tumbuhan }}">
                                </td>
                                @if (auth()->user()->username == 'superviser')
                                <td>{{ $item->asal_wilker }}</td>
                                @endif
                                <td>{{ date('d F Y', strtotime($item->tgl_kegiatan)) }}</td>
                                <td>{{ $item->asal }}</td>
                                <td>{{ $item->tujuan }}</td>
                                <td>{{ $item->jenis_komoditas }}</td>
                                <td>{{ $item->nama_komoditas }}</td>
                                <td>{{ number_format($item->jml_komoditas) }}</td>
                                <td>{{ $item->satuan_komoditas }}</td>
                                <td>Rp {{ number_format($item->harga_komoditas) }}</td>
                                <td>Rp {{ number_format($item->tot_pnbp) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="hapusEksporTbh" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Hapus Data Ekspor Tumbuhan</strong></h5>
            </div>
            <div class="modal-body">
                <p>Anda Yakin Ingin Menghapus Data Ekspor Tumbuhan Tersebut</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="button" onclick="hapusEksporTumbuhan()" class="btn btn-sm btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('table')

<script type="text/javascript">
    $(document).ready(function () {
        $('#table-ekspor-t').DataTable({
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ],
            responsive: true,
            scrollY: true,
            scrollX: true,
        });
    });

    $("#head-cb").on('click', function () {
        var isChecked = $("#head-cb").prop('checked');
        $(".cb-body").prop('checked', isChecked)
        $("#editEksporTumbuhan").prop('disabled', !isChecked);
        $("#hapusEksporTumbuhan").prop('disabled', !isChecked);
    });

    $("#table-ekspor-t tbody").on('click', '.cb-body', function () {
        if ($(this).prop('checked') != true) {
            $("#head-cb").prop('checked', false)
        }

        let semua_cb = $("#table-ekspor-t tbody .cb-body:checked")
        let btn_nonAktif = (semua_cb.length > 0)
        $("#editEksporTumbuhan").prop('disabled', !btn_nonAktif);
        $("#hapusEksporTumbuhan").prop('disabled', !btn_nonAktif);
    });

    function editEksporTumbuhan() {
        let cb_terpilih = $("#table-ekspor-t tbody .cb-body:checked");
        let semua_id = [];
        $.each(cb_terpilih, function (index, elm) {
            semua_id.push(elm.value)
        });
        $.ajax({
            url: "/eksporTumbuhan/edit/" + semua_id,
            type: 'GET',
            data: {
                id: semua_id
            },
            success: function () {
                window.location = "/eksporTumbuhan/edit/" + semua_id
            }
        });

    }

    function hapusEksporTumbuhan() {
        let cb_terpilih = $("#table-ekspor-t tbody .cb-body:checked");
        let semua_id = [];
        $.each(cb_terpilih, function (index, elm) {
            semua_id.push(elm.value)
        });
        $.ajax({
            url: "/eksporTumbuhan/hapus",
            method: "POST",
            data: {
                id: semua_id
            },
            success: function () {
                location.reload();
            }
        });
    }

</script>

@endsection
