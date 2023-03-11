<?php

namespace App\Imports;

use App\Models\KomoditasTumbuhan;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Throwable;

class TumbuhanImport implements
ToModel,
WithHeadingRow,
SkipsOnError,
WithValidation,
SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $error = [];
    public function model(array $row)
    {
        // dd($row);
        // ddd($jmp);
        $lokasi = auth()->user()->lokasi;
        if (!empty($row['nama_wilker'])) {
            if (strpos($row['nama_wilker'],$lokasi) !== FALSE ) {
                return new KomoditasTumbuhan([
                    'kode_kegiatan' => $row['no_aju'],
                    'tgl_kegiatan' => Date::excelToDateTimeObject($row['tanggal_permohonan']),
                    'jalur_komoditas' => $row['jenis_permohonan'],
                    'asal_wilker' => $lokasi,
                    'kota_asal' => $row['kota_asal'],
                    'asal' => $row['asal'],
                    'kota_tujuan' => $row['kota_tuju'],
                    'tujuan' => $row['tujuan'],
                    'jenis_komoditas' => $row['golongan'],
                    'nama_komoditas' => $row['nama_komoditas'],
                    'jml_komoditas' => $row['volume_netto'],
                    'satuan_komoditas' => $row['sat_netto'],
                    'harga_komoditas' => $row['harga'],
                    'tot_pnbp' => $row['total_pnbp']
                ]);
            } else {
                $this->error = ['tidak'. $row['nama_wilker']];
            }
        }
    }

    public function rules(): array
    {
        return [
            '*no_aju' => ['unique:komoditas_tumbuhan,kode_kegiatan'],
        ];
    }

    public function getErrorT()
    {
        return $this->error;
    }
}
