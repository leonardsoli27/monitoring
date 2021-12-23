<?php

namespace App\Http\Controllers;

use App\Models\KomoditasHewan;
use App\Models\KomoditasTumbuhan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RincianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = Carbon::now()->isoFormat('Y');
        $user = auth()->user()->username;
        $wilker = auth()->user()->lokasi;
        $filter = request('tahun');
        $nma_wilker = request('nama_wilker');
        $nama_wilker = User::where('username', '!=', 'superviser')->get();

        if (request('tahun')) {
            if ($user == 'superviser') {
                if ($nma_wilker != 'Semua Wilker') {
                    $rincian_h = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Hewan')
                                ->where('asal_wilker', $nma_wilker)
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_hewan', 'DESC')
                                ->get();

                    $rincian_bah = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'B.A.H.')
                                    ->where('asal_wilker', $nma_wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->get();

                    $rincian_hbah = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'H.B.A.H.')
                                    ->where('asal_wilker', $nma_wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->get();

                    $rincian_bl = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Benda Lain')
                                    ->where('asal_wilker', $nma_wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->get();
                } else {
                    $rincian_h = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Hewan')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_hewan', 'DESC')
                                ->get();

                    $rincian_bah = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'B.A.H.')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->get();

                    $rincian_hbah = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'H.B.A.H.')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->get();

                    $rincian_bl = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Benda Lain')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->get();
                }
            } else {
                $rincian_h = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Hewan')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_hewan', 'DESC')
                                ->get();

                    $rincian_bah = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'B.A.H.')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->get();

                    $rincian_hbah = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'H.B.A.H.')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->get();

                    $rincian_bl = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Benda Lain')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->get();
            }
        } else {
            if ($user == 'superviser') {
                $rincian_h = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Hewan')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_hewan', 'DESC')
                                ->get();

                $rincian_bah = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'B.A.H.')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_hewan', 'DESC')
                                ->get();

                $rincian_hbah = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'H.B.A.H.')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_hewan', 'DESC')
                                ->get();

                $rincian_bl = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Benda Lain')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_hewan', 'DESC')
                                ->get();
            } else {
                $rincian_h = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Hewan')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->where('asal_wilker', $wilker)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_hewan', 'DESC')
                                ->get();

                $rincian_bah = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'B.A.H.')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->where('asal_wilker', $wilker)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_hewan', 'DESC')
                                ->get();

                $rincian_hbah = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'H.B.A.H.')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->where('asal_wilker', $wilker)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_hewan', 'DESC')
                                ->get();

                $rincian_bl = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Benda Lain')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->where('asal_wilker', $wilker)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_hewan', 'DESC')
                                ->get();
            }
        }
        // dd($rincian_h);

        return view('Rincian.rincianHewan', compact('rincian_h', 'rincian_bah', 'rincian_hbah', 'rincian_bl', 'nama_wilker'));
    }

    public function index_t()
    {
        $tahun = Carbon::now()->isoFormat('Y');
        $user = auth()->user()->username;
        $wilker = auth()->user()->lokasi;
        $filter = request('tahun');
        $nma_wilker = request('nama_wilker');
        $nama_wilker = User::where('username', '!=', 'superviser')->get();

        if (request('tahun')) {
           if ($user == 'superviser') {
               if ($nma_wilker != 'Semua Wilker') {
                    $rincian_bt = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Bibit Tanaman')
                                ->where('asal_wilker', $nma_wilker)
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_tumbuhan', 'DESC')
                                ->get();

                    $rincian_htm = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Hasil Tanaman Mati')
                                    ->where('asal_wilker', $nma_wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->get();

                    $rincian_hth = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Hasil Tanaman Hidup')
                                    ->where('asal_wilker', $nma_wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->get();

                    $rincian_bl = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Benda Lain')
                                    ->where('asal_wilker', $nma_wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->get();
               } else {
                    $rincian_bt = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Bibit Tanaman')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_tumbuhan', 'DESC')
                                ->get();

                    $rincian_htm = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Hasil Tanaman Mati')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->get();

                    $rincian_hth = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Hasil Tanaman Hidup')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->get();

                    $rincian_bl = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Benda Lain')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->get();
               }
           } else {
                    $rincian_bt = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Bibit Tanaman')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_tumbuhan', 'DESC')
                                ->get();

                    $rincian_htm = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Hasil Tanaman Mati')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->get();

                    $rincian_hth = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Hasil Tanaman Hidup')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->get();

                    $rincian_bl = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Benda Lain')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->get();
           }
        } else {
            if ($user == 'superviser') {
                    $rincian_bt = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Bibit Tanaman')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_tumbuhan', 'DESC')
                                ->get();

                    $rincian_htm = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Hasil Tanaman Mati')
                                    ->whereYear('tgl_kegiatan', $tahun)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->get();

                    $rincian_hth = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Hasil Tanaman Hidup')
                                    ->whereYear('tgl_kegiatan', $tahun)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->get();

                    $rincian_bl = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Benda Lain')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_tumbuhan', 'DESC')
                                ->get();
            } else {
                    $rincian_bt = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Bibit Tanaman')
                                ->where('asal_wilker', $wilker)
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_tumbuhan', 'DESC')
                                ->get();

                    $rincian_htm = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Hasil Tanaman Mati')
                                    ->where('asal_wilker', $wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->get();

                    $rincian_hth = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                    ->where('jenis_komoditas', 'Hasil Tanaman Hidup')
                                    ->where('asal_wilker', $wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->get();

                    $rincian_bl = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"), "satuan_komoditas")
                                ->where('jenis_komoditas', 'Benda Lain')
                                ->where('asal_wilker', $wilker)
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('nama_komoditas', 'satuan_komoditas')
                                ->orderBy('jml_tumbuhan', 'DESC')
                                ->get();
            }
        }
        return view('Rincian.rincianTumbuhan', compact('rincian_bt', 'rincian_htm', 'rincian_hth', 'rincian_bl', 'nama_wilker'));
    }

    public function jalur()
    {
        $tahun = Carbon::now()->isoFormat('Y');
        $user = auth()->user()->username;
        $wilker = auth()->user()->lokasi;
        $filter = request('tahun');
        $nma_wilker = request('nama_wilker');
        $nama_wilker = User::where('username', '!=', 'superviser')->get();

        if (request('tahun')) {
            if ($user == 'superviser') {
               if ($nma_wilker != 'Semua Wilker') {
                    // domas
                    $rincian_domas_h = KomoditasHewan::select("kota_asal", DB::raw("COUNT(kota_asal) as domas_hewan"))
                                    ->where('jalur_komoditas', 'DOMAS')
                                    ->where('asal_wilker', $nma_wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('kota_asal')
                                    ->orderBy('domas_hewan', 'DESC')
                                    ->get();

                    $rincian_domas_t = KomoditasTumbuhan::select("kota_asal", DB::raw("COUNT(kota_asal) as domas_tumbuhan"))
                                    ->where('jalur_komoditas', 'DOMAS')
                                    ->where('asal_wilker', $nma_wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('kota_asal')
                                    ->orderBy('domas_tumbuhan', 'DESC')
                                    ->get();

                    // dokel
                    $rincian_dokel_h = KomoditasHewan::select("kota_tujuan", DB::raw("COUNT(kota_tujuan) as dokel_hewan"))
                                    ->where('jalur_komoditas', 'DOKEL')
                                    ->where('asal_wilker', $nma_wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('kota_tujuan')
                                    ->orderBy('dokel_hewan', 'DESC')
                                    ->get();

                    $rincian_dokel_t = KomoditasTumbuhan::select("kota_tujuan", DB::raw("COUNT(kota_tujuan) as dokel_tumbuhan"))
                                    ->where('jalur_komoditas', 'DOKEL')
                                    ->where('asal_wilker', $nma_wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('kota_tujuan')
                                    ->orderBy('dokel_tumbuhan', 'DESC')
                                    ->get();

                    // import
                    $rincian_impor_h = KomoditasHewan::select("asal", DB::raw("COUNT(asal) as impor_hewan"))
                                    ->where('jalur_komoditas', 'Impor')
                                    ->where('asal_wilker', $nma_wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('asal')
                                    ->orderBy('impor_hewan', 'DESC')
                                    ->get();

                    $rincian_impor_t = KomoditasTumbuhan::select("asal", DB::raw("COUNT(asal) as impor_tumbuhan"))
                                    ->where('jalur_komoditas', 'Impor')
                                    ->where('asal_wilker', $nma_wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('asal')
                                    ->orderBy('impor_tumbuhan', 'DESC')
                                    ->get();

                    // ekspor
                    $rincian_ekspor_h = KomoditasHewan::select("tujuan", DB::raw("COUNT(tujuan) as ekspor_hewan"))
                                    ->where('jalur_komoditas', 'Ekspor')
                                    ->where('asal_wilker', $nma_wilker)
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('tujuan')
                                    ->orderBy('ekspor_hewan', 'DESC')
                                    ->get();

                    $rincian_ekspor_t = KomoditasTumbuhan::select("tujuan", DB::raw("COUNT(tujuan) as ekspor_tumbuhan"))
                                ->where('jalur_komoditas', 'Ekspor')
                                ->where('asal_wilker', $nma_wilker)
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('tujuan')
                                ->orderBy('ekspor_tumbuhan', 'DESC')
                                ->get();

               } else {
                    // domas
                    $rincian_domas_h = KomoditasHewan::select("kota_asal", DB::raw("COUNT(kota_asal) as domas_hewan"))
                                    ->where('jalur_komoditas', 'DOMAS')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('kota_asal')
                                    ->orderBy('domas_hewan', 'DESC')
                                    ->get();

                    $rincian_domas_t = KomoditasTumbuhan::select("kota_asal", DB::raw("COUNT(kota_asal) as domas_tumbuhan"))
                                    ->where('jalur_komoditas', 'DOMAS')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('kota_asal')
                                    ->orderBy('domas_tumbuhan', 'DESC')
                                    ->get();

                    // dokel
                    $rincian_dokel_h = KomoditasHewan::select("kota_tujuan", DB::raw("COUNT(kota_tujuan) as dokel_hewan"))
                                    ->where('jalur_komoditas', 'DOKEL')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('kota_tujuan')
                                    ->orderBy('dokel_hewan', 'DESC')
                                    ->get();

                    $rincian_dokel_t = KomoditasTumbuhan::select("kota_tujuan", DB::raw("COUNT(kota_tujuan) as dokel_tumbuhan"))
                                    ->where('jalur_komoditas', 'DOKEL')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('kota_tujuan')
                                    ->orderBy('dokel_tumbuhan', 'DESC')
                                    ->get();

                    // import
                    $rincian_impor_h = KomoditasHewan::select("asal", DB::raw("COUNT(asal) as impor_hewan"))
                                    ->where('jalur_komoditas', 'Impor')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('asal')
                                    ->orderBy('impor_hewan', 'DESC')
                                    ->get();

                    $rincian_impor_t = KomoditasTumbuhan::select("asal", DB::raw("COUNT(asal) as impor_tumbuhan"))
                                    ->where('jalur_komoditas', 'Impor')
                                    ->whereYear('tgl_kegiatan', $filter)
                                    ->groupBy('asal')
                                    ->orderBy('impor_tumbuhan', 'DESC')
                                    ->get();

                    // ekspor
                    $rincian_ekspor_h = KomoditasHewan::select("tujuan", DB::raw("COUNT(tujuan) as ekspor_hewan"))
                                ->where('jalur_komoditas', 'Ekspor')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('tujuan')
                                ->orderBy('ekspor_hewan', 'DESC')
                                ->get();

                    $rincian_ekspor_t = KomoditasTumbuhan::select("tujuan", DB::raw("COUNT(tujuan) as ekspor_tumbuhan"))
                                ->where('jalur_komoditas', 'Ekspor')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('tujuan')
                                ->orderBy('ekspor_tumbuhan', 'DESC')
                                ->get();

               }

            } else {
                // domas
                $rincian_domas_h = KomoditasHewan::select("kota_asal", DB::raw("COUNT(kota_asal) as domas_hewan"))
                                ->where('jalur_komoditas', 'DOMAS')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('kota_asal')
                                ->orderBy('domas_hewan', 'DESC')
                                ->get();

                $rincian_domas_t = KomoditasTumbuhan::select("kota_asal", DB::raw("COUNT(kota_asal) as domas_tumbuhan"))
                                ->where('jalur_komoditas', 'DOMAS')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('kota_asal')
                                ->orderBy('domas_tumbuhan', 'DESC')
                                ->get();

                // dokel
                $rincian_dokel_h = KomoditasHewan::select("kota_tujuan", DB::raw("COUNT(kota_tujuan) as dokel_hewan"))
                                ->where('jalur_komoditas', 'DOKEL')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('kota_tujuan')
                                ->orderBy('dokel_hewan', 'DESC')
                                ->get();

                $rincian_dokel_t = KomoditasTumbuhan::select("kota_tujuan", DB::raw("COUNT(kota_tujuan) as dokel_tumbuhan"))
                                ->where('jalur_komoditas', 'DOKEL')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('kota_tujuan')
                                ->orderBy('dokel_tumbuhan', 'DESC')
                                ->get();

                // import
                $rincian_impor_h = KomoditasHewan::select("asal", DB::raw("COUNT(asal) as impor_hewan"))
                                ->where('jalur_komoditas', 'Impor')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('asal')
                                ->orderBy('impor_hewan', 'DESC')
                                ->get();

                $rincian_impor_t = KomoditasTumbuhan::select("asal", DB::raw("COUNT(asal) as impor_tumbuhan"))
                                ->where('jalur_komoditas', 'Impor')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy('asal')
                                ->orderBy('impor_tumbuhan', 'DESC')
                                ->get();

                // ekspor
                $rincian_ekspor_h = KomoditasHewan::select("tujuan", DB::raw("COUNT(tujuan) as ekspor_hewan"))
                            ->where('jalur_komoditas', 'Ekspor')
                            ->whereYear('tgl_kegiatan', $filter)
                            ->groupBy('tujuan')
                            ->orderBy('ekspor_hewan', 'DESC')
                            ->get();

                $rincian_ekspor_t = KomoditasTumbuhan::select("tujuan", DB::raw("COUNT(tujuan) as ekspor_tumbuhan"))
                            ->where('jalur_komoditas', 'Ekspor')
                            ->whereYear('tgl_kegiatan', $filter)
                            ->groupBy('tujuan')
                            ->orderBy('ekspor_tumbuhan', 'DESC')
                            ->get();

            }
            // batas
        } else {
            if ($user == 'superviser') {
                // domas
                $rincian_domas_h = KomoditasHewan::select("kota_asal", DB::raw("COUNT(kota_asal) as domas_hewan"))
                                ->where('jalur_komoditas', 'DOMAS')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('kota_asal')
                                ->orderBy('domas_hewan', 'DESC')
                                ->get();

                $rincian_domas_t = KomoditasTumbuhan::select("kota_asal", DB::raw("COUNT(kota_asal) as domas_tumbuhan"))
                                ->where('jalur_komoditas', 'DOMAS')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('kota_asal')
                                ->orderBy('domas_tumbuhan', 'DESC')
                                ->get();

                // dokel
                $rincian_dokel_h = KomoditasHewan::select("kota_tujuan", DB::raw("COUNT(kota_tujuan) as dokel_hewan"))
                                ->where('jalur_komoditas', 'DOKEL')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('kota_tujuan')
                                ->orderBy('dokel_hewan', 'DESC')
                                ->get();

                $rincian_dokel_t = KomoditasTumbuhan::select("kota_tujuan", DB::raw("COUNT(kota_tujuan) as dokel_tumbuhan"))
                                ->where('jalur_komoditas', 'DOKEL')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('kota_tujuan')
                                ->orderBy('dokel_tumbuhan', 'DESC')
                                ->get();

                // import
                $rincian_impor_h = KomoditasHewan::select("asal", DB::raw("COUNT(asal) as impor_hewan"))
                                ->where('jalur_komoditas', 'Impor')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('asal')
                                ->orderBy('impor_hewan', 'DESC')
                                ->get();

                $rincian_impor_t = KomoditasTumbuhan::select("asal", DB::raw("COUNT(asal) as impor_tumbuhan"))
                                ->where('jalur_komoditas', 'Impor')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('asal')
                                ->orderBy('impor_tumbuhan', 'DESC')
                                ->get();

                // ekspor
                $rincian_ekspor_h = KomoditasHewan::select("tujuan", DB::raw("COUNT(tujuan) as ekspor_hewan"))
                                ->where('jalur_komoditas', 'Ekspor')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('tujuan')
                                ->orderBy('ekspor_hewan', 'DESC')
                                ->get();

                $rincian_ekspor_t = KomoditasTumbuhan::select("tujuan", DB::raw("COUNT(tujuan) as ekspor_tumbuhan"))
                                ->where('jalur_komoditas', 'Ekspor')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->groupBy('tujuan')
                                ->orderBy('ekspor_tumbuhan', 'DESC')
                                ->get();
            } else {
                // domas
                $rincian_domas_h = KomoditasHewan::select("kota_asal", DB::raw("COUNT(kota_asal) as domas_hewan"))
                                ->where('jalur_komoditas', 'DOMAS')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->where('asal_wilker', $wilker)
                                ->groupBy('kota_asal')
                                ->orderBy('domas_hewan', 'DESC')
                                ->get();

                $rincian_domas_t = KomoditasTumbuhan::select("kota_asal", DB::raw("COUNT(kota_asal) as domas_tumbuhan"))
                                ->where('jalur_komoditas', 'DOMAS')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->where('asal_wilker', $wilker)
                                ->groupBy('kota_asal')
                                ->orderBy('domas_tumbuhan', 'DESC')
                                ->get();

                // dokel
                $rincian_dokel_h = KomoditasHewan::select("kota_tujuan", DB::raw("COUNT(kota_tujuan) as dokel_hewan"))
                                ->where('jalur_komoditas', 'DOKEL')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->where('asal_wilker', $wilker)
                                ->groupBy('kota_tujuan')
                                ->orderBy('dokel_hewan', 'DESC')
                                ->get();

                $rincian_dokel_t = KomoditasTumbuhan::select("kota_tujuan", DB::raw("COUNT(kota_tujuan) as dokel_tumbuhan"))
                                ->where('jalur_komoditas', 'DOKEL')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->where('asal_wilker', $wilker)
                                ->groupBy('kota_tujuan')
                                ->orderBy('dokel_tumbuhan', 'DESC')
                                ->get();

                // import
                $rincian_impor_h = KomoditasHewan::select("asal", DB::raw("COUNT(asal) as impor_hewan"))
                                ->where('jalur_komoditas', 'Impor')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->where('asal_wilker', $wilker)
                                ->groupBy('asal')
                                ->orderBy('impor_hewan', 'DESC')
                                ->get();

                $rincian_impor_t = KomoditasTumbuhan::select("asal", DB::raw("COUNT(asal) as impor_tumbuhan"))
                                ->where('jalur_komoditas', 'Impor')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->where('asal_wilker', $wilker)
                                ->groupBy('asal')
                                ->orderBy('impor_tumbuhan', 'DESC')
                                ->get();

                // ekspor
                $rincian_ekspor_h = KomoditasHewan::select("tujuan", DB::raw("COUNT(tujuan) as ekspor_hewan"))
                                ->where('jalur_komoditas', 'Ekspor')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->where('asal_wilker', $wilker)
                                ->groupBy('tujuan')
                                ->orderBy('ekspor_hewan', 'DESC')
                                ->get();

                $rincian_ekspor_t = KomoditasTumbuhan::select("tujuan", DB::raw("COUNT(tujuan) as ekspor_tumbuhan"))
                                ->where('jalur_komoditas', 'Ekspor')
                                ->whereYear('tgl_kegiatan', $tahun)
                                ->where('asal_wilker', $wilker)
                                ->groupBy('tujuan')
                                ->orderBy('ekspor_tumbuhan', 'DESC')
                                ->get();
            }
        }

        return view('Rincian.rincianJalur', compact('rincian_domas_h', 'rincian_domas_t', 'rincian_dokel_h', 'rincian_dokel_t', 'rincian_impor_h', 'rincian_impor_t', 'rincian_ekspor_h', 'rincian_ekspor_t', 'nama_wilker'));
    }
}
