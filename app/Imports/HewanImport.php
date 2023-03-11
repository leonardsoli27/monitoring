<?php

namespace App\Imports;

use App\Models\KomoditasHewan;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Throwable;

class HewanImport implements
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
        // dd($row['nama_wilker']);

        // dd($lokasi);
        $lokasi = auth()->user()->lokasi;
        if (!empty($row['nama_wilker'])) {
            if (strpos($row['nama_wilker'],$lokasi) !== FALSE) {
                return new KomoditasHewan([
                    'kode_kegiatan' => $row['no_aju'],
                    'tgl_kegiatan' => Date::excelToDateTimeObject($row['tanggal_permohonan']),
                    'jalur_komoditas' => $row['jenis_permohonan'],
                    'asal_wilker' => $row['nama_wilker'],
                    'kota_asal' => $row['kota_asal'],
                    'asal' => $row['asal'],
                    'kota_tujuan' => $row['kota_tuju'],
                    'tujuan' => $row['tujuan'],
                    'jenis_komoditas' => $row['jenis_mp'],
                    'nama_komoditas' => $row['nama_mp'],
                    'jml_komoditas' => $row['jumlah'],
                    'satuan_komoditas' => $row['satuan'],
                    'harga_komoditas' => $row['harga'],
                    'tot_pnbp' => $row['total_pnbp']
                ]);
            } else {
                $this->error = ['tidak '. $row['nama_wilker']];
            }
        }
    }

    public function rules(): array
    {
        return [
            '*no_aju' => ['unique:komoditas_hewan,kode_kegiatan'],
        ];
    }

    public function getError()
    {
        return $this->error;
    }
}
