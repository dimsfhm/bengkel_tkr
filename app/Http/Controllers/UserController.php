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
            'role'     => 'required|in:user,petugas,admin', // sesuaikan dengan role yang ada
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

    //Update
   public function edit($id)
{
    return redirect()->route('admin.data-user');
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role'  => 'required|in:user,petugas,admin',
        'password' => 'nullable|min:6',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    // hanya update password kalau diisi
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('admin.data-user')->with('success', 'User berhasil diupdate.');
}
}

