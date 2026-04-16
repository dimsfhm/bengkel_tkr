<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.data-user', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:users,petugas,admin', // sesuaikan dengan role yang ada
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,  // <-- pastikan ini tersimpan
        ]);

        return redirect()->route('admin.data-user')->with('success', 'User berhasil ditambahkan.');
    }

    // Opsional: method destroy
public function destroy($id)
{
    $user = \App\Models\User::findOrFail($id);

    // Cegah menghapus diri sendiri
    if ($user->id == auth()->id()) {
        return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
    }

    $user->delete();

    return redirect()->route('admin.data-user')->with('success', 'User berhasil dihapus.');
}
}

