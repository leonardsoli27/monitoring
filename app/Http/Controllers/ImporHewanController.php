<?php

namespace App\Http\Controllers;

use App\Models\KomoditasHewan;
use App\Models\User;
use Illuminate\Http\Request;

class ImporHewanController extends Controller
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
            $imporhewan = KomoditasHewan::where('jalur_komoditas', 'Impor')->get();
        } elseif ($user != 'superviser') {
            $imporhewan = KomoditasHewan::where('jalur_komoditas', 'Impor')->where('asal_wilker', $lokasi)->get();
        }
        return view('Impor.imporHewan', compact('imporhewan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $jmlImporH = explode(",",$id);

        $editImporHewan = KomoditasHewan::where('jalur_komoditas', 'Impor')
                    ->whereIn('id_komoditas_hewan', $jmlImporH)
                    ->get();
        // dd($editDomasHewan);
        return view('Impor.editImporHewan', compact('editImporHewan'));
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
        KomoditasHewan::where('jalur_komoditas', 'Impor')
                    ->whereIn('id_komoditas_hewan', $request->id)
                    ->delete();

        alert()->success('Berhasil','Data Berhasil Terhapus.');
        return response()->json(true);
    }
}
