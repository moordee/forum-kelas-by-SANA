<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // validate input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // get data from tb_siswa
        $siswa = DB::table('tb_siswa')
                    ->where('username', $request->username)
                    ->first();

        // check if id exists AND password matches (plain text)
        if ($siswa && $siswa->password === $request->password) {

            // store session
            session([
                'siswa_logged_in' => true,
                'siswa_username' => $siswa->username,
                'siswa_name' => $siswa->nama ?? ''
            ]);

            return redirect()->route('beranda');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
