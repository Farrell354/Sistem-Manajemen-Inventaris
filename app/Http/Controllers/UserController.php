<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    // Tampilkan daftar pengguna
    public function index()
    {
        // Pastikan hanya Super Admin (role_id = 1) yang bisa akses halaman ini
        if (auth()->user()->role_id != 1) {
            abort(403, 'Akses Ditolak. Hanya Super Admin yang diizinkan.');
        }

        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    // Form tambah pengguna baru
    public function create()
    {
        if (auth()->user()->role_id != 1) {
            abort(403);
        }
        return view('users.create');
    }

    // Simpan pengguna baru ke database
    public function store(Request $request)
    {
        if (auth()->user()->role_id != 1) {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'integer'], // 1=Admin, 2=Manager, 3=Staff
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Akun pegawai baru berhasil ditambahkan!');
    }
    // Menghapus pengguna
    public function destroy(User $user)
    {
        if (auth()->user()->role_id != 1) {
            abort(403);
        }

        // Pengaman: Jangan biarkan Super Admin menghapus akunnya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri!');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Akun pegawai berhasil dihapus!');
    }
    // Menampilkan form edit
    public function edit(User $user)
    {
        if (auth()->user()->role_id != 1) {
            abort(403);
        }
        return view('users.edit', compact('user'));
    }

    // Menyimpan perubahan data
    public function update(Request $request, User $user)
    {
        if (auth()->user()->role_id != 1) {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Pengecualian email unique untuk user yang sedang diedit
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role_id' => ['required', 'integer'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];

        // Jika password diisi, berarti minta diganti. Jika kosong, biarkan password lama.
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }
}
