@extends('layout.main')

@section('user', 'active')

@section('content')

<style>
    div.dataTables_wrapper {
        width: 1400px;
        margin: 0 auto;
    }

</style>

<div class="row">
    <div class="col-md-12 pl-0 pr-2">
        <div class="card">
            <div class="card-header">
                <div class="row g-3 align-items-center">
                    <div class="col-lg">
                        <strong class="card-title">Data Akun Wilker</strong>
                    </div>
                    <div class="col-lg text-right mr-3 pt-2 pb-2">
                        <a href="/user/register" class="btn btn-sm btn-primary"><i
                                class="menu-icon fa fa-plus-square"></i> Tambah Wilker</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="user-data-table" class="table table-striped table-bordered display nowrap">
                        <thead>
                            <tr>
                                <th>Nama Wilker</th>
                                <th>Penanggung Jawab</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wilker as $item)
                            <tr>
                                <td>{{ $item->lokasi }}</td>
                                <td>{{ $item->admin_wilker }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <a href="#detail_user{{ $item->id_user }}" data-toggle="modal"
                                        class="btn btn-info btn-sm"><i class="menu-icon fa fa-eye"></i></a>
                                    <a href="user/edit/{{ $item->id_user }}" class="btn btn-warning btn-sm"><i
                                            class="menu-icon fa fa-pencil-square-o"></i></a>
                                    <a href="#hapus_user{{ $item->id_user }}" data-toggle="modal"
                                        class="btn btn-danger btn-sm"><i class="menu-icon fa fa-trash-o"></i></a>
                                </td>
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
@foreach ($wilker as $item)
<div class="modal fade" id="detail_user{{ $item->id_user }}" tabindex="-1" role="dialog"
    aria-labelledby="detail_userLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="modal-title" id="detail_userLabel">Data Akun {{ $item->lokasi }}</strong>
            </div>
            <div class="modal-body">
                <p><b>Lokasi :</b> {{ $item->lokasi }}</p>
                <hr size="1">
                <p><b>Admin Wilker :</b> {{ $item->admin_wilker }}</p>
                <hr size="1">
                <p><b>Username Wilker :</b> {{ $item->username }}</p>
                <hr size="1">
                <p><b>Email Wilker :</b> <i>{{ $item->email }}</i></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>


@endforeach

<!-- Modal -->
@foreach ($wilker as $item)
<div class="modal fade" id="hapus_user{{ $item->id_user }}" tabindex="-1" role="dialog"
    aria-labelledby="hapus_userLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="modal-title" id="hapus_userLabel">Hapus Akun {{ $item->lokasi }}</strong>
            </div>
            <div class="modal-body">
                <p>Anda Yakin Ingin Menghapus Akun Wilker {{ $item->lokasi }}</p>
            </div>
            <div class="modal-footer">
                <form action="/user/hapus/{{ $item->id_user }}" method="POST">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
@endforeach



@endsection

@section('table')
<script type="text/javascript">
    $(document).ready(function () {
        $('#user-data-table').DataTable({
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ],
            scrollY: true,
            scrollX: true,
            responsive: true
        });
    });

</script>
@endsection
