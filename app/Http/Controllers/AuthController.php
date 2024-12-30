<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Ekanban\ekanban_user_tbl as User;
use App\Models\Ekanban\Ekanban_user_tbl;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $user = $request->input('user');
        $password = md5($request->input('password')); // MD5 hash

        $check = Ekanban_user_tbl::where('user', $user)
            ->where('pass', $password)
            ->first();

            if ($check) {
                // Check if the user is authenticated correctly
                Auth::login($check);
                return redirect('/dashboard');
            } else {
                // Log error details
                Session::flash('message', 'User atau Password salah');
                Session::flash('error', 'Silahkan login kembali');
                return redirect('/login');
            }
    }


    // Logout user
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
