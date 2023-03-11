<?php

namespace App\Http\Controllers;

use App\Models\KomoditasHewan;
use App\Models\KomoditasTumbuhan;
use App\Models\NamaKomoditasHewan;
use App\Models\NamaKomoditasTumbuhan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = Carbon::now()->isoFormat('Y');
        $filter = request('tahun');
        $wilker = request('nama_wilker');
        $nama_wilker = User::where('username', '!=', 'superviser')->get();

        if (request('tahun')) {
            if (auth()->user()->username == 'superviser') {
                if (request('nama_wilker') != 'Semua Wilker') {
                    $f_hewan_domas = KomoditasHewan::where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->count('asal_wilker');
                    $f_tumbuhan_domas = KomoditasTumbuhan::where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->count('asal_wilker');
                    $nama_hewan_domas = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'DOMAS')
                                ->where('asal_wilker', $wilker)
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_hewan_domas = count($nama_hewan_domas);
                    $nama_tumbuhan_domas = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'DOMAS')
                                ->where('asal_wilker', $wilker)
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_tumbuhan_domas = count($nama_tumbuhan_domas);
                    $pnbp_hewan_domas = KomoditasHewan::where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->sum('tot_pnbp');
                    $pnbp_tumbuhan_domas = KomoditasTumbuhan::where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->sum('tot_pnbp');

                    // dokel
                    $f_hewan_dokel = KomoditasHewan::where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->count('asal_wilker');
                    $f_tumbuhan_dokel = KomoditasTumbuhan::where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->count('asal_wilker');
                    $nama_hewan_dokel = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'DOKEL')
                                ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_hewan_dokel = count($nama_hewan_dokel);
                    $nama_tumbuhan_dokel = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'DOKEL')
                                ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_tumbuhan_dokel = count($nama_tumbuhan_dokel);
                    $pnbp_hewan_dokel = KomoditasHewan::where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->sum('tot_pnbp');
                    $pnbp_tumbuhan_dokel = KomoditasTumbuhan::where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->sum('tot_pnbp');

                    // impor
                    $f_hewan_impor = KomoditasHewan::where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->count('asal_wilker');
                    $f_tumbuhan_impor = KomoditasTumbuhan::where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->count('asal_wilker');
                    $nama_hewan_impor = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'Impor')
                                ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_hewan_impor = count($nama_hewan_impor);
                    $nama_tumbuhan_impor = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'Impor')
                                ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_tumbuhan_impor = count($nama_tumbuhan_impor);
                    $pnbp_hewan_impor = KomoditasHewan::where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->sum('tot_pnbp');
                    $pnbp_tumbuhan_impor = KomoditasTumbuhan::where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->sum('tot_pnbp');

                    // ekspor
                    $f_hewan_ekspor = KomoditasHewan::where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->count('asal_wilker');
                    $f_tumbuhan_ekspor = KomoditasTumbuhan::where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->count('asal_wilker');
                    $nama_hewan_ekspor = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'Ekspor')
                                ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_hewan_ekspor = count($nama_hewan_ekspor);
                    $nama_tumbuhan_ekspor = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'Ekspor')
                                ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_tumbuhan_ekspor = count($nama_tumbuhan_ekspor);
                    $pnbp_hewan_ekspor = KomoditasHewan::where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->sum('tot_pnbp');
                    $pnbp_tumbuhan_ekspor = KomoditasTumbuhan::where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)->sum('tot_pnbp');


                    // Line Chart
                    // Domas
                    $kegiatan_domas_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_domas_h"))
                                            ->where('jalur_komoditas', 'DOMAS')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_domas_h');

                    $kegiatan_domas_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_domas_t"))
                                            ->where('jalur_komoditas', 'DOMAS')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_domas_t');

                    $domas_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'DOMAS')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    $domas_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'DOMAS')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    // Dokel
                    $kegiatan_dokel_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_dokel_h"))
                                            ->where('jalur_komoditas', 'DOKEL')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_dokel_h');

                    $kegiatan_dokel_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_dokel_t"))
                                            ->where('jalur_komoditas', 'DOKEL')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_dokel_t');

                    $dokel_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'DOKEL')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    $dokel_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'DOKEL')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    // Impor
                    $kegiatan_impor_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_impor_h"))
                                            ->where('jalur_komoditas', 'Impor')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_impor_h');

                    $kegiatan_impor_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_impor_t"))
                                            ->where('jalur_komoditas', 'Impor')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_impor_t');

                    $impor_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'Impor')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    $impor_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'Impor')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    // Ekspor
                    $kegiatan_ekspor_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_ekspor_h"))
                                            ->where('jalur_komoditas', 'ekspor')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_ekspor_h');

                    $kegiatan_ekspor_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_ekspor_t"))
                                            ->where('jalur_komoditas', 'ekspor')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_ekspor_t');

                    $ekspor_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'ekspor')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    $ekspor_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'ekspor')
                                            ->whereYear('tgl_kegiatan', $filter)->where('asal_wilker', $wilker)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');
                } else {
                    $f_hewan_domas = KomoditasHewan::where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                    $f_tumbuhan_domas = KomoditasTumbuhan::where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                    $nama_hewan_domas = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'DOMAS')

                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_hewan_domas = count($nama_hewan_domas);
                    $nama_tumbuhan_domas = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'DOMAS')

                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_tumbuhan_domas = count($nama_tumbuhan_domas);
                    $pnbp_hewan_domas = KomoditasHewan::where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');
                    $pnbp_tumbuhan_domas = KomoditasTumbuhan::where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');

                    // dokel
                    $f_hewan_dokel = KomoditasHewan::where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                    $f_tumbuhan_dokel = KomoditasTumbuhan::where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                    $nama_hewan_dokel = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'DOKEL')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_hewan_dokel = count($nama_hewan_dokel);
                    $nama_tumbuhan_dokel = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'DOKEL')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_tumbuhan_dokel = count($nama_tumbuhan_dokel);
                    $pnbp_hewan_dokel = KomoditasHewan::where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');
                    $pnbp_tumbuhan_dokel = KomoditasTumbuhan::where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');

                    // impor
                    $f_hewan_impor = KomoditasHewan::where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                    $f_tumbuhan_impor = KomoditasTumbuhan::where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                    $nama_hewan_impor = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'Impor')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_hewan_impor = count($nama_hewan_impor);
                    $nama_tumbuhan_impor = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'Impor')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_tumbuhan_impor = count($nama_tumbuhan_impor);
                    $pnbp_hewan_impor = KomoditasHewan::where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');
                    $pnbp_tumbuhan_impor = KomoditasTumbuhan::where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');

                    // ekspor
                    $f_hewan_ekspor = KomoditasHewan::where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                    $f_tumbuhan_ekspor = KomoditasTumbuhan::where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                    $nama_hewan_ekspor = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'Ekspor')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_hewan_ekspor = count($nama_hewan_ekspor);
                    $nama_tumbuhan_ekspor = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                                ->where('jalur_komoditas', 'Ekspor')
                                ->whereYear('tgl_kegiatan', $filter)
                                ->groupBy(DB::raw("nama_komoditas"))
                                ->pluck('nama');
                    $r_tumbuhan_ekspor = count($nama_tumbuhan_ekspor);
                    $pnbp_hewan_ekspor = KomoditasHewan::where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');
                    $pnbp_tumbuhan_ekspor = KomoditasTumbuhan::where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');


                    // Line Chart
                    // Domas
                    $kegiatan_domas_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_domas_h"))
                                            ->where('jalur_komoditas', 'DOMAS')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_domas_h');

                    $kegiatan_domas_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_domas_t"))
                                            ->where('jalur_komoditas', 'DOMAS')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_domas_t');

                    $domas_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'DOMAS')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    $domas_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'DOMAS')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    // Dokel
                    $kegiatan_dokel_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_dokel_h"))
                                            ->where('jalur_komoditas', 'DOKEL')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_dokel_h');

                    $kegiatan_dokel_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_dokel_t"))
                                            ->where('jalur_komoditas', 'DOKEL')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_dokel_t');

                    $dokel_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'DOKEL')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    $dokel_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'DOKEL')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    // Impor
                    $kegiatan_impor_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_impor_h"))
                                            ->where('jalur_komoditas', 'Impor')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_impor_h');

                    $kegiatan_impor_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_impor_t"))
                                            ->where('jalur_komoditas', 'Impor')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_impor_t');

                    $impor_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'Impor')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    $impor_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'Impor')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    // Ekspor
                    $kegiatan_ekspor_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_ekspor_h"))
                                            ->where('jalur_komoditas', 'ekspor')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_ekspor_h');

                    $kegiatan_ekspor_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_ekspor_t"))
                                            ->where('jalur_komoditas', 'ekspor')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('jml_ekspor_t');

                    $ekspor_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'ekspor')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');

                    $ekspor_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                            ->where('jalur_komoditas', 'ekspor')
                                            ->whereYear('tgl_kegiatan', $filter)
                                            ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                            ->pluck('bulan');
                                            // batas
                }
            }
            else {
                // Donut Chart
                // domas
                $lokasi = auth()->user()->lokasi;
                // dd($user);

                $f_hewan_domas = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                $f_tumbuhan_domas = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                $nama_hewan_domas = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOMAS')
                            ->whereYear('tgl_kegiatan', $filter)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_hewan_domas = count($nama_hewan_domas);
                $nama_tumbuhan_domas = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOMAS')
                            ->whereYear('tgl_kegiatan', $filter)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_tumbuhan_domas = count($nama_tumbuhan_domas);
                $pnbp_hewan_domas = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');
                $pnbp_tumbuhan_domas = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');

                // dokel
                $f_hewan_dokel = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                $f_tumbuhan_dokel = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                $nama_hewan_dokel = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOKEL')
                            ->whereYear('tgl_kegiatan', $filter)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_hewan_dokel = count($nama_hewan_dokel);
                $nama_tumbuhan_dokel = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOKEL')
                            ->whereYear('tgl_kegiatan', $filter)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_tumbuhan_dokel = count($nama_tumbuhan_dokel);
                $pnbp_hewan_dokel = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');
                $pnbp_tumbuhan_dokel = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');

                // impor
                $f_hewan_impor = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                $f_tumbuhan_impor = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                $nama_hewan_impor = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Impor')
                            ->whereYear('tgl_kegiatan', $filter)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_hewan_impor = count($nama_hewan_impor);
                $nama_tumbuhan_impor = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Impor')
                            ->whereYear('tgl_kegiatan', $filter)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_tumbuhan_impor = count($nama_tumbuhan_impor);
                $pnbp_hewan_impor = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');
                $pnbp_tumbuhan_impor = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');

                // ekspor
                $f_hewan_ekspor = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                $f_tumbuhan_ekspor = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $filter)->count('asal_wilker');
                $nama_hewan_ekspor = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Ekspor')
                            ->whereYear('tgl_kegiatan', $filter)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_hewan_ekspor = count($nama_hewan_ekspor);
                $nama_tumbuhan_ekspor = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Ekspor')
                            ->whereYear('tgl_kegiatan', $filter)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_tumbuhan_ekspor = count($nama_tumbuhan_ekspor);
                $pnbp_hewan_ekspor = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');
                $pnbp_tumbuhan_ekspor = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $filter)->sum('tot_pnbp');


                // Line Chart
                // Domas
                $kegiatan_domas_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_domas_h"))
                                        ->where('jalur_komoditas', 'DOMAS')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_domas_h');

                $kegiatan_domas_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_domas_t"))
                                        ->where('jalur_komoditas', 'DOMAS')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_domas_t');

                $domas_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'DOMAS')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                $domas_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'DOMAS')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                // Dokel
                $kegiatan_dokel_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_dokel_h"))
                                        ->where('jalur_komoditas', 'DOKEL')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_dokel_h');

                $kegiatan_dokel_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_dokel_t"))
                                        ->where('jalur_komoditas', 'DOKEL')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_dokel_t');

                $dokel_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'DOKEL')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                $dokel_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'DOKEL')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                // Impor
                $kegiatan_impor_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_impor_h"))
                                        ->where('jalur_komoditas', 'Impor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_impor_h');

                $kegiatan_impor_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_impor_t"))
                                        ->where('jalur_komoditas', 'Impor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_impor_t');

                $impor_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'Impor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                $impor_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'Impor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                // Ekspor
                $kegiatan_ekspor_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_ekspor_h"))
                                        ->where('jalur_komoditas', 'ekspor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_ekspor_h');

                $kegiatan_ekspor_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_ekspor_t"))
                                        ->where('jalur_komoditas', 'ekspor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_ekspor_t');

                $ekspor_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'ekspor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                $ekspor_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'ekspor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $filter)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

            }
        } else {
            // if no filter
            if (auth()->user()->username == 'superviser') {
                $f_hewan_domas = KomoditasHewan::where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $f_tumbuhan_domas = KomoditasTumbuhan::where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $nama_hewan_domas = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                            ->where('jalur_komoditas', 'DOMAS')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_hewan_domas = count($nama_hewan_domas);
                $nama_tumbuhan_domas = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                            ->where('jalur_komoditas', 'DOMAS')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_tumbuhan_domas = count($nama_tumbuhan_domas);
                $pnbp_hewan_domas = KomoditasHewan::where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');
                $pnbp_tumbuhan_domas = KomoditasTumbuhan::where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');

                // dokel
                $f_hewan_dokel = KomoditasHewan::where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $f_tumbuhan_dokel = KomoditasTumbuhan::where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $nama_hewan_dokel = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                            ->where('jalur_komoditas', 'DOKEL')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_hewan_dokel = count($nama_hewan_dokel);
                $nama_tumbuhan_dokel = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                            ->where('jalur_komoditas', 'DOKEL')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_tumbuhan_dokel = count($nama_tumbuhan_dokel);
                $pnbp_hewan_dokel = KomoditasHewan::where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');
                $pnbp_tumbuhan_dokel = KomoditasTumbuhan::where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');

                // impor
                $f_hewan_impor = KomoditasHewan::where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $f_tumbuhan_impor = KomoditasTumbuhan::where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $nama_hewan_impor = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                            ->where('jalur_komoditas', 'Impor')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_hewan_impor = count($nama_hewan_impor);
                $nama_tumbuhan_impor = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                            ->where('jalur_komoditas', 'Impor')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_tumbuhan_impor = count($nama_tumbuhan_impor);
                $pnbp_hewan_impor = KomoditasHewan::where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');
                $pnbp_tumbuhan_impor = KomoditasTumbuhan::where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');

                // ekspor
                $f_hewan_ekspor = KomoditasHewan::where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $f_tumbuhan_ekspor = KomoditasTumbuhan::where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $nama_hewan_ekspor = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                            ->where('jalur_komoditas', 'Ekspor')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_hewan_ekspor = count($nama_hewan_ekspor);
                $nama_tumbuhan_ekspor = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                            ->where('jalur_komoditas', 'Ekspor')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_tumbuhan_ekspor = count($nama_tumbuhan_ekspor);
                $pnbp_hewan_ekspor = KomoditasHewan::where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');
                $pnbp_tumbuhan_ekspor = KomoditasTumbuhan::where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');


                // Line Chart
                // Domas
                $kegiatan_domas_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_domas_h"))
                                        ->where('jalur_komoditas', 'DOMAS')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_domas_h');

                $kegiatan_domas_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_domas_t"))
                                        ->where('jalur_komoditas', 'DOMAS')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_domas_t');

                $domas_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'DOMAS')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                $domas_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'DOMAS')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                // Dokel
                $kegiatan_dokel_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_dokel_h"))
                                        ->where('jalur_komoditas', 'DOKEL')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_dokel_h');

                $kegiatan_dokel_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_dokel_t"))
                                        ->where('jalur_komoditas', 'DOKEL')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_dokel_t');

                $dokel_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'DOKEL')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                $dokel_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'DOKEL')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                // Impor
                $kegiatan_impor_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_impor_h"))
                                        ->where('jalur_komoditas', 'Impor')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_impor_h');

                $kegiatan_impor_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_impor_t"))
                                        ->where('jalur_komoditas', 'Impor')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_impor_t');

                $impor_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'Impor')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                $impor_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'Impor')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                // Ekspor
                $kegiatan_ekspor_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_ekspor_h"))
                                        ->where('jalur_komoditas', 'ekspor')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_ekspor_h');

                $kegiatan_ekspor_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_ekspor_t"))
                                        ->where('jalur_komoditas', 'ekspor')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_ekspor_t');

                $ekspor_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'ekspor')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                $ekspor_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'ekspor')
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

            }
            else {
                // Donut Chart
                // domas
                $lokasi = auth()->user()->lokasi;
                // dd($user);

                $f_hewan_domas = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $f_tumbuhan_domas = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $nama_hewan_domas = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOMAS')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_hewan_domas = count($nama_hewan_domas);
                $nama_tumbuhan_domas = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOMAS')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_tumbuhan_domas = count($nama_tumbuhan_domas);
                $pnbp_hewan_domas = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');
                $pnbp_tumbuhan_domas = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOMAS')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');

                // dokel
                $f_hewan_dokel = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $f_tumbuhan_dokel = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $nama_hewan_dokel = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOKEL')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_hewan_dokel = count($nama_hewan_dokel);
                $nama_tumbuhan_dokel = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOKEL')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_tumbuhan_dokel = count($nama_tumbuhan_dokel);
                $pnbp_hewan_dokel = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');
                $pnbp_tumbuhan_dokel = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'DOKEL')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');

                // impor
                $f_hewan_impor = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $f_tumbuhan_impor = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $nama_hewan_impor = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Impor')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_hewan_impor = count($nama_hewan_impor);
                $nama_tumbuhan_impor = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Impor')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_tumbuhan_impor = count($nama_tumbuhan_impor);
                $pnbp_hewan_impor = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');
                $pnbp_tumbuhan_impor = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Impor')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');

                // ekspor
                $f_hewan_ekspor = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $f_tumbuhan_ekspor = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $tahun)->count('asal_wilker');
                $nama_hewan_ekspor = KomoditasHewan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Ekspor')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_hewan_ekspor = count($nama_hewan_ekspor);
                $nama_tumbuhan_ekspor = KomoditasTumbuhan::select(DB::raw("nama_komoditas as nama"))
                            ->where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Ekspor')
                            ->whereYear('tgl_kegiatan', $tahun)
                            ->groupBy(DB::raw("nama_komoditas"))
                            ->pluck('nama');
                $r_tumbuhan_ekspor = count($nama_tumbuhan_ekspor);
                $pnbp_hewan_ekspor = KomoditasHewan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');
                $pnbp_tumbuhan_ekspor = KomoditasTumbuhan::where('asal_wilker', $lokasi)->where('jalur_komoditas', 'Ekspor')->whereYear('tgl_kegiatan', $tahun)->sum('tot_pnbp');


                // Line Chart
                // Domas
                $kegiatan_domas_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_domas_h"))
                                        ->where('jalur_komoditas', 'DOMAS')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_domas_h');

                $kegiatan_domas_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_domas_t"))
                                        ->where('jalur_komoditas', 'DOMAS')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_domas_t');

                $domas_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'DOMAS')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                $domas_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'DOMAS')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                // Dokel
                $kegiatan_dokel_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_dokel_h"))
                                        ->where('jalur_komoditas', 'DOKEL')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_dokel_h');

                $kegiatan_dokel_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_dokel_t"))
                                        ->where('jalur_komoditas', 'DOKEL')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_dokel_t');

                $dokel_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'DOKEL')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                $dokel_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'DOKEL')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                // Impor
                $kegiatan_impor_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_impor_h"))
                                        ->where('jalur_komoditas', 'Impor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_impor_h');

                $kegiatan_impor_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_impor_t"))
                                        ->where('jalur_komoditas', 'Impor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_impor_t');

                $impor_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'Impor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                $impor_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'Impor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                // Ekspor
                $kegiatan_ekspor_hewan = KomoditasHewan::select(DB::raw("COUNT(*) as jml_ekspor_h"))
                                        ->where('jalur_komoditas', 'ekspor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_ekspor_h');

                $kegiatan_ekspor_tumbuhan = KomoditasTumbuhan::select(DB::raw("COUNT(*) as jml_ekspor_t"))
                                        ->where('jalur_komoditas', 'ekspor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('jml_ekspor_t');

                $ekspor_bulan_h = KomoditasHewan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'ekspor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

                $ekspor_bulan_t = KomoditasTumbuhan::select(DB::raw("Month(tgl_kegiatan) as bulan"))
                                        ->where('jalur_komoditas', 'ekspor')
                                        ->where('asal_wilker', $lokasi)
                                        ->whereYear('tgl_kegiatan', $tahun)
                                        ->groupBy(DB::raw("Month(tgl_kegiatan)"))
                                        ->pluck('bulan');

            }
        }

        // Domas
        $data_domas_hewan = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($domas_bulan_h as $index => $bulan_domas) {
            $data_domas_hewan[$bulan_domas - 1 ] = $kegiatan_domas_hewan[$index];
        }

        $data_domas_tumbuhan = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($domas_bulan_t as $index => $bulan_domas) {
            $data_domas_tumbuhan[$bulan_domas - 1 ] = $kegiatan_domas_tumbuhan[$index];
        }

        // Dokel
        $data_dokel_hewan = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($dokel_bulan_h as $index => $bulan_dokel) {
            $data_dokel_hewan[$bulan_dokel - 1 ] = $kegiatan_dokel_hewan[$index];
        }

        $data_dokel_tumbuhan = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($dokel_bulan_t as $index => $bulan_dokel) {
            $data_dokel_tumbuhan[$bulan_dokel - 1 ] = $kegiatan_dokel_tumbuhan[$index];
        }

        // Impor
        $data_impor_hewan = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($impor_bulan_h as $index => $bulan_impor) {
            $data_impor_hewan[$bulan_impor - 1 ] = $kegiatan_impor_hewan[$index];
        }

        $data_impor_tumbuhan = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($impor_bulan_t as $index => $bulan_impor) {
            $data_impor_tumbuhan[$bulan_impor - 1 ] = $kegiatan_impor_tumbuhan[$index];
        }

        // Ekspor
        $data_ekspor_hewan = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($ekspor_bulan_h as $index => $bulan_ekspor) {
            $data_ekspor_hewan[$bulan_ekspor - 1 ] = $kegiatan_ekspor_hewan[$index];
        }

        $data_ekspor_tumbuhan = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($ekspor_bulan_t as $index => $bulan_ekspor) {
            $data_ekspor_tumbuhan[$bulan_ekspor - 1 ] = $kegiatan_ekspor_tumbuhan[$index];
        }

        return view("dashboard", compact('f_hewan_domas', 'f_tumbuhan_domas', 'r_hewan_domas', 'r_tumbuhan_domas', 'pnbp_hewan_domas', 'pnbp_tumbuhan_domas',
                'f_hewan_dokel', 'f_tumbuhan_dokel', 'r_hewan_dokel', 'r_tumbuhan_dokel', 'pnbp_hewan_dokel', 'pnbp_tumbuhan_dokel',
                'f_hewan_impor', 'f_tumbuhan_impor', 'r_hewan_impor', 'r_tumbuhan_impor', 'pnbp_hewan_impor', 'pnbp_tumbuhan_impor',
                'f_hewan_ekspor', 'f_tumbuhan_ekspor', 'r_hewan_ekspor', 'r_tumbuhan_ekspor', 'pnbp_hewan_ekspor', 'pnbp_tumbuhan_ekspor',
                'data_domas_hewan', 'data_domas_tumbuhan', 'data_dokel_hewan', 'data_dokel_tumbuhan', 'data_impor_hewan', 'data_impor_tumbuhan',
                'data_ekspor_hewan', 'data_ekspor_tumbuhan', 'tahun', 'wilker', 'nama_wilker'));
    }
}
