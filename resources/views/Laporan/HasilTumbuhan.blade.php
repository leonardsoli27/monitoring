<!DOCTYPE html>
<html>

<head>
    <title>Laporan Rekapitulasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td {
            font-size: 9pt;
        }

        table thead tr th {
            text-align: center;
            font-size: 11pt;
        }

        .total th {
            font-size: 11pt;
            color: red;
        }

        hr {
            margin-top: 1px;
            margin-bottom: 30px;
            border: 2px;
            color: rgb(4, 79, 102);
        }

        img {
            height: 100px;
            width: 100px;
        }

    </style>

    <center>
        <img src="images/logo1.png" alt="">
        <h5>RINCIAN KOMODITI TUMBUHAN DAN PENERIMAAN <br> NEGARA BUKAN PAJAK FUNGSIONAL</h4> <br>
            @if (auth()->user()->username == 'superviser')
            @if ($asal_wilker != "Semua")
            "{{ $asal_wilker }}"
            @else
            "Keseluruhan Wilker"
            @endif
            @else
            "{{ auth()->user()->lokasi }}"
            @endif
            <br>
            <h6>Tanggal : {{ date('d-M-Y', strtotiMe($dari)) }} -
                {{ date('d-M-Y', strtotime($sampai)) }}
        </h5>
    </center>
    <hr>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Komoditas</th>
                <th>Jumlah</th>
                <th>PNBP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataTumbuhan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_komoditas }}</td>
                <td>{{ number_format($item->jml_tumbuhan) }} {{  $item->satuan_komoditas  }}</td>
                <td>Rp {{ number_format($item->pnbp) }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <th colspan="3"><b>Total PNBP</b></th>
                <th><b>Rp {{ number_format($dataTumbuhan->SUM('pnbp')) }}</b></th>
            </tr>
        </tbody>
    </table>

</body>

</html>
