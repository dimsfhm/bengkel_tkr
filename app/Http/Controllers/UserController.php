<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.data-user', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'role' => 'required|in:user, petugas, admin',

            ]);
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,


         ]);
         return redirect()->route('admin.data-user');
    }
}
