<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->username != 'superviser') {
            return abort(403,'Anda tidak punya akses ke halaman ini');
        }
        $wilker = User::where('username', '!=', 'superviser')->get();
        return view("Users.users", compact('wilker'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->username != 'superviser') {
            return abort(403,'Anda tidak punya akses ke halaman ini');
        }
        $dataUser = $request->validate([
            'lokasi' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'admin_wilker' => 'required|min:5',
            'username' => 'required|min:5|max:255',
            'password' => 'required|min:5|max:255'
        ]);

        $dataUser['password'] = bcrypt($dataUser['password']);

        User::create($dataUser);
        toast('Data Berhasil Ditambahkan','success');
        // Alert::success('Data Berhasil Ditambahkan');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profil = User::where('id_user', $id)->get();
       return view('Users.profil', compact('profil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wilker = User::where('id_user', $id)->get();
        return view('Users.edtUser', compact('wilker'));
    }

    public function password(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed'
        ]);

        $cekPassword = auth()->user()->password;

        $old_password = $request->old_password;

        if (Hash::check($old_password, $cekPassword)) {
            User::where('id_user', $id)->update([
                'password' => bcrypt($request->get('password'))
            ]);

            alert()->success('Berhasil','Password Berhasil Diperbaharui.');
            return back();
        } else {
            alert()->error('Gagal','Password Gagal Diperbaharui.');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::where('id_user', $id)->get();

        $rules = [
            'lokasi' => 'required|min:3|max:255',
            'admin_wilker' => 'required|min:5',
            'username' => 'required|min:5|max:255'
        ];

        if ($request->email != $user[0]->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

       $validate = $request->validate($rules);

       User::where('id_user', $id)->update($validate);

       alert()->success('Berhasil','Data Berhasil Diperbaharui.');
       return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->username != 'superviser') {
            return abort(403,'Anda tidak punya akses ke halaman ini');
        }

        DB::table('users')->where('id_user', $id)->delete();
        alert()->success('Berhasil','Data Berhasil Terhapus.');
        return redirect('/user');
    }
}
