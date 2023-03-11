<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function index()
   {
        return view("auth.login");
   }

   public function store(Request $request)
   {

       $dataLogin = $request->validate([
            'username' => 'required',
            'password' => 'required'
       ]);

       if (Auth::attempt($dataLogin)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        } else {
            toast('Username Tidak Tersedia','error');
            return back();
        }

   }

   public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        toast('Berhasil Logout','success');
        return redirect('/');
    }
}


         //    $username = $request->username;
    //    $password = $request->password;

    //    $remember_me = $request->has('remember_me')? true:false;
    //    if (Auth::attempt(['username' => $username, 'password' => $password], $remember_me)) {
    //         $username = auth()->user()->username;
    //         $password = auth()->user()->password;
    //    } else {
    //       return back();
    //       toast('Username Tidak Tersedia','error');
    //    }
