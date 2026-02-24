<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login-register');
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email','password'))) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            if ($role == 'admin') {
                return redirect('/admin')->with('success', 'Login Berhasil!');
            } elseif ($role == 'petugas') {
                return redirect('/petugas')->with('success', 'Login Berhasil!');
            } else {
                return redirect('/peminjam')->with('success', 'Login Berhasil!');
            }
        }

        return back()->withErrors([
            'login' => 'Username atau Password salah!.'
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerProses(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:user',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
            'alamat' => 'required'
        ]);

        $tambah_user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($request->password),
            'role' => 'user', // default
            'alamat' => $validate['alamat']
        ]);

        return redirect('/')->with('success','Register berhasil');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}