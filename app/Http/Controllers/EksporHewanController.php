<?php

namespace App\Http\Controllers;

use App\Models\KomoditasHewan;
use App\Models\User;
use Illuminate\Http\Request;

class EksporHewanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->username;
        $lokasi = auth()->user()->lokasi;
        if ($user == 'superviser') {
            $eksporhewan = KomoditasHewan::where('jalur_komoditas', 'Ekspor')->get();
        } elseif ($user != 'superviser') {
            $eksporhewan = KomoditasHewan::where('jalur_komoditas', 'Ekspor')->where('asal_wilker', $lokasi)->get();
        }
        return view('Ekspor.eksporHewan', compact('eksporhewan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $jmlEksporH = explode(",",$id);

        $editEksporHewan = KomoditasHewan::where('jalur_komoditas', 'Ekspor')
                    ->whereIn('id_komoditas_hewan', $jmlEksporH)
                    ->get();
        // dd($editDomasHewan);
        return view('Ekspor.editEksporHewan', compact('editEksporHewan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
                'nama_komoditas' => 'required',
                'jumlah' => 'required',
                'satuan' => 'required']);

        // dd($request->all());

        $jml_edit = count($request->id);

        $wilker = auth()->user()->lokasi;

        for ($i=0; $i < $jml_edit; $i++) {
            $form_edit = array(
                'id_komoditas_hewan' => $request->id[$i],
                'nama_komoditas' => $request->nama_komoditas[$i],
                'satuan_komoditas' => $request->satuan[$i]
            );
            KomoditasHewan::where('id_komoditas_hewan', $request->id[$i])
                            ->where('asal_wilker', $wilker)->update($form_edit);
        }

        alert()->success('Berhasil','Data Berhasil Diedit.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        KomoditasHewan::where('jalur_komoditas', 'Ekspor')
                    ->whereIn('id_komoditas_hewan', $request->id)
                    ->delete();

        alert()->success('Berhasil','Data Berhasil Terhapus.');
        return response()->json(true);
    }
}
