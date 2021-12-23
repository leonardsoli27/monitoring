<?php

namespace App\Http\Controllers;

use App\Imports\HewanImport;
use App\Imports\TumbuhanImport;
use App\Models\JalurKomoditas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaluLintasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->username == 'superviser') {
            return abort(403,'Anda tidak punya akses ke halaman ini');
        }
        return view('tbhLaluLintas');
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
            return abort(403,'Anda tidak punya akses ke halaman ini');
        }
        $request->validate(["file_hewan" => "required|mimes:xls,xlsx"]);

        $file = $request->file('file_hewan');
        $namaFile = $file->getClientOriginalName();

        $importHewan = new HewanImport;
        $importHewan->import($file);
        $file->move(public_path() . '/Import', $namaFile);

        $error = $importHewan->getError();
        // dd($error);
        foreach ($error as $key => $value) {
            if (strpos($value,'tidak') !== FALSE) {
                alert()->error('Gagal','Data Tidak Sesuai Dengan Wilker.');
                return back();
            }
        }

        // dd(count($importHewan->failures()));
        if (count($importHewan->failures()) > 0) {
            alert()->info('Duplikasi','Terdapat Data Duplikat Yang Tidak Masukkan.');
            return back();
        }
        alert()->success('Berhasil','Data Berhasil Hewan Diimport.');
        return back();
    }

    public function store_t(Request $request)
    {
        if (auth()->user()->username == 'superviser') {
            return abort(403,'Anda tidak punya akses ke halaman ini');
        }

        $request->validate(["file_tumbuhan" => "required|mimes:xls,xlsx"]);

        $fileT = $request->file('file_tumbuhan');
        $namaFile = $fileT->getClientOriginalName();

        $importTumbuhan = new TumbuhanImport;
        $importTumbuhan->import($fileT);
        $fileT->move(public_path() . '/Import', $namaFile);

        $error = $importTumbuhan->getErrorT();

        foreach ($error as $key => $value) {
            if (strpos($value,'tidak') !== FALSE) {
                alert()->error('Gagal','Data Tidak Sesuai Dengan Wilker.');
                return back();
            }
        }

        // dd(count($importTumbuhan->failures()));
        if (count($importTumbuhan->failures()) > 0) {
            alert()->info('Duplikasi','Terdapat Data Duplikat Yang Tidak Masukkan.');
            return back();
        }

        alert()->success('Berhasil','Data Berhasil Tumbuhan Diimport.');
        return back();
    }

}
