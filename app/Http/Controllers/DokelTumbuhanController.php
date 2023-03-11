<?php

namespace App\Http\Controllers;

use App\Models\KomoditasTumbuhan;
use App\Models\User;
use Illuminate\Http\Request;

class DokelTumbuhanController extends Controller
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
            $dokeltumbuhan = KomoditasTumbuhan::where('jalur_komoditas', 'DOKEL')->get();
        } elseif ($user != 'superviser') {
            $dokeltumbuhan = KomoditasTumbuhan::where('jalur_komoditas', 'DOKEL')->where('asal_wilker', $lokasi)->get();
        }
        return view('Dokel.dokelTumbuhan', compact('dokeltumbuhan'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $jmlDokelTbh = explode(",",$id);

        $editDokelTumbuhan = KomoditasTumbuhan::where('jalur_komoditas', 'DOKEL')
                    ->whereIn('id_komoditas_tumbuhan', $jmlDokelTbh)
                    ->get();
        // dd($editDomasHewan);
        return view('Dokel.editDokelTumbuhan', compact('editDokelTumbuhan'));
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

        $jmlDomasTbh = count($request->id);

        $wilker = auth()->user()->lokasi;

        if (auth()->user()->usename == 'superviser') {
            for ($i=0; $i < $jmlDomasTbh; $i++) {
                $form_edit = array(
                    'id_komoditas_tumbuhan' => $request->id[$i],
                    'nama_komoditas' => $request->nama_komoditas[$i],
                    'satuan_komoditas' => $request->satuan[$i]
                );
                KomoditasTumbuhan::where('id_komoditas_tumbuhan', $request->id[$i])
                                ->update($form_edit);
            }
        } else {
            for ($i=0; $i < $jmlDomasTbh; $i++) {
                $form_edit = array(
                    'id_komoditas_tumbuhan' => $request->id[$i],
                    'nama_komoditas' => $request->nama_komoditas[$i],
                    'satuan_komoditas' => $request->satuan[$i]
                );
                KomoditasTumbuhan::where('id_komoditas_tumbuhan', $request->id[$i])
                ->where('asal_wilker', $wilker)->update($form_edit);
            }
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
        KomoditasTumbuhan::where('jalur_komoditas', 'DOKEL')
                    ->whereIn('id_komoditas_tumbuhan', $request->id)
                    ->delete();

        alert()->success('Berhasil','Data Berhasil Terhapus.');
        return response()->json(true);
    }
}
