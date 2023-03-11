<?php

namespace App\Http\Controllers;

use App\Models\KategoriKomoditas;
use App\Models\KomoditasHewan;
use App\Models\KomoditasTumbuhan;
use App\Models\KotaAsal;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wilker = User::where('lokasi', '!=', 'Wilker Pusat' )->get();
        return view('Laporan.Laporan', compact('wilker'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->username == 'superviser') {
            $request->validate([
                'dari' => 'required',
                'sampai' => 'required',
                'asal_wilker' => 'required',
                'jalur_komoditas' => 'required',
                'jenis_komoditas' => 'required'
            ]);
        } else {
            $request->validate([
                'dari' => 'required',
                'sampai' => 'required',
                'jalur_komoditas' => 'required',
                'jenis_komoditas' => 'required'
            ]);
        }

        $wilker = auth()->user()->lokasi;
        $dari = $request->dari;
        $sampai = $request->sampai;
        $asal_wilker = $request->asal_wilker;
        $jenis_komoditas = $request->jenis_komoditas;
        $jalur_komoditas = $request->jalur_komoditas;
        $cek = Carbon::today();
        $hari_ini = $cek->toDateString();

        // dd($hari_ini);

        if ($dari > $sampai) {
            alert()->error('Data Gagal Dicetak','Tanggal Dari Melebihi Tanggal Sampai.');
            return back();
        }

        if ($dari > $hari_ini) {
            alert()->error('Data Gagal Dicetak.','Tanggal Dari Melebihi Hari Ini.');
            return back();
        }

        if ( $sampai > $hari_ini) {
            alert()->error('Data Gagal Dicetak.','Tanggal Sampai Melebihi Hari Ini.');
            return back();
        }

        if (auth()->user()->username == 'superviser') {
            if ($request->asal_wilker == "Semua") {
                if ($request->jalur_komoditas == "Semua") {
                    if ($request->jenis_komoditas == "Semua") {
                        $dataHewan = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();
                        $dataTumbuhan = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();
                    } elseif ($request->jenis_komoditas == "Hewan") {
                        $dataHewan = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();
                    } elseif ($request->jenis_komoditas == "Tumbuhan") {
                        $dataTumbuhan = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();
                    }
                } elseif ($request->jalur_komoditas != "Semua") {
                    if ($request->jenis_komoditas == "Semua") {
                         $dataHewan = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->where('jalur_komoditas', $jalur_komoditas)
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();
                         $dataTumbuhan = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->where('jalur_komoditas', $jalur_komoditas)
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();
                    } elseif ($request->jenis_komoditas == "Hewan") {
                        $dataHewan = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->where('jalur_komoditas', $jalur_komoditas)
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();
                    } elseif ($request->jenis_komoditas == "Tumbuhan") {
                        $dataTumbuhan = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_tumbuhan', 'DESC')
                                    ->where('jalur_komoditas', $jalur_komoditas)
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();
                    }
                }
            } else {
                // where asal wilker != Semua
                if ($request->jalur_komoditas == "Semua") {
                    if ($request->jenis_komoditas == "Semua") {
                        $dataHewan = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->where('asal_wilker', $asal_wilker)
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();

                        $dataTumbuhan = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"),
                                        DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                        ->groupBy('nama_komoditas', 'satuan_komoditas')
                                        ->orderBy('jml_tumbuhan', 'DESC')
                                        ->where('asal_wilker', $asal_wilker)
                                        ->where('tgl_kegiatan', '>=', $dari)
                                        ->where('tgl_kegiatan', '<=', $sampai)->get();
                    } elseif ($request->jenis_komoditas == "Hewan") {
                        $dataHewan = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->where('asal_wilker', $asal_wilker)
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();
                    } elseif ($request->jenis_komoditas == "Tumbuhan") {
                        $dataTumbuhan = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"),
                                        DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                        ->groupBy('nama_komoditas', 'satuan_komoditas')
                                        ->orderBy('jml_tumbuhan', 'DESC')
                                        ->where('asal_wilker', $asal_wilker)
                                        ->where('tgl_kegiatan', '>=', $dari)
                                        ->where('tgl_kegiatan', '<=', $sampai)->get();
                    }
                } elseif ($request->jalur_komoditas != "Semua") {
                    if ($request->jenis_komoditas == "Semua") {
                        $dataHewan = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->where('asal_wilker', $asal_wilker)
                                    ->where('jalur_komoditas', $jalur_komoditas)
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();

                        $dataTumbuhan = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"),
                                        DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                        ->groupBy('nama_komoditas', 'satuan_komoditas')
                                        ->orderBy('jml_tumbuhan', 'DESC')
                                        ->where('asal_wilker', $asal_wilker)
                                        ->where('jalur_komoditas', $jalur_komoditas)
                                        ->where('tgl_kegiatan', '>=', $dari)
                                        ->where('tgl_kegiatan', '<=', $sampai)->get();
                    } elseif ($request->jenis_komoditas == "Hewan") {
                        $dataHewan = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->where('asal_wilker', $asal_wilker)
                                    ->where('jalur_komoditas', $jalur_komoditas)
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();
                    } elseif ($request->jenis_komoditas == "Tumbuhan") {
                        $dataTumbuhan = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"),
                                        DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                        ->groupBy('nama_komoditas', 'satuan_komoditas')
                                        ->orderBy('jml_tumbuhan', 'DESC')
                                        ->where('asal_wilker', $asal_wilker)
                                        ->where('jalur_komoditas', $jalur_komoditas)
                                        ->where('tgl_kegiatan', '>=', $dari)
                                        ->where('tgl_kegiatan', '<=', $sampai)->get();
                    }
                }
            }
        } else {
            // where bukan superviser
            if ($request->jalur_komoditas == "Semua") {
                if ($request->jenis_komoditas == "Semua") {
                    $dataHewan = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->where('asal_wilker', $wilker)
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();

                        $dataTumbuhan = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"),
                                        DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                        ->groupBy('nama_komoditas', 'satuan_komoditas')
                                        ->orderBy('jml_tumbuhan', 'DESC')
                                        ->where('asal_wilker', $wilker)
                                        ->where('tgl_kegiatan', '>=', $dari)
                                        ->where('tgl_kegiatan', '<=', $sampai)->get();
                } elseif ($request->jenis_komoditas == "Hewan") {
                     $dataHewan = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->where('asal_wilker', $wilker)
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();
                } elseif ($request->jenis_komoditas == "Tumbuhan") {
                    $dataTumbuhan = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"),
                                        DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                        ->groupBy('nama_komoditas', 'satuan_komoditas')
                                        ->orderBy('jml_tumbuhan', 'DESC')
                                        ->where('asal_wilker', $wilker)
                                        ->where('tgl_kegiatan', '>=', $dari)
                                        ->where('tgl_kegiatan', '<=', $sampai)->get();
                }
            } elseif ($request->jalur_komoditas != "Semua") {
                if ($request->jenis_komoditas == "Semua") {
                    $dataHewan = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->where('asal_wilker', $wilker)
                                    ->where('jalur_komoditas', $jalur_komoditas)
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();

                        $dataTumbuhan = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"),
                                        DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                        ->groupBy('nama_komoditas', 'satuan_komoditas')
                                        ->orderBy('jml_tumbuhan', 'DESC')
                                        ->where('asal_wilker', $wilker)
                                        ->where('jalur_komoditas', $jalur_komoditas)
                                        ->where('tgl_kegiatan', '>=', $dari)
                                        ->where('tgl_kegiatan', '<=', $sampai)->get();
                } elseif ($request->jenis_komoditas == "Hewan") {
                    $dataHewan = KomoditasHewan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_hewan"),
                                    DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                    ->groupBy('nama_komoditas', 'satuan_komoditas')
                                    ->orderBy('jml_hewan', 'DESC')
                                    ->where('asal_wilker', $wilker)
                                    ->where('jalur_komoditas', $jalur_komoditas)
                                    ->where('tgl_kegiatan', '>=', $dari)
                                    ->where('tgl_kegiatan', '<=', $sampai)->get();
                } elseif ($request->jenis_komoditas == "Tumbuhan") {
                     $dataTumbuhan = KomoditasTumbuhan::select("nama_komoditas" , DB::raw("SUM(jml_komoditas) as jml_tumbuhan"),
                                        DB::raw("SUM(tot_pnbp) as pnbp"), "satuan_komoditas")
                                        ->groupBy('nama_komoditas', 'satuan_komoditas')
                                        ->orderBy('jml_tumbuhan', 'DESC')
                                        ->where('asal_wilker', $wilker)
                                        ->where('jalur_komoditas', $jalur_komoditas)
                                        ->where('tgl_kegiatan', '>=', $dari)
                                        ->where('tgl_kegiatan', '<=', $sampai)->get();
                }
            }
        }

        // dd([$dataHewan->SUM('pnbp'), $dataTumbuhan->SUM('pnbp')]);

        if ($jenis_komoditas == 'Hewan') {
            $pdf = PDF::loadView('Laporan.HasilHewan', compact('dataHewan', 'dari', 'sampai', 'asal_wilker'))->setPaper('A4', 'potrait');
            return $pdf->stream('Laporan.pdf');
        } elseif ($jenis_komoditas == 'Tumbuhan') {
            $pdf = PDF::loadView('Laporan.HasilTumbuhan', compact('dataTumbuhan', 'dari', 'sampai', 'asal_wilker'))->setPaper('A4', 'potrait');
            return $pdf->stream('Laporan.pdf');
        }
    }

}
