<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.users', compact('users'));
    }

    public function toggle($id)
    {
        $user = User::findOrFail($id);
        // Kita gunakan kolom email_verified_at untuk aktif/nonaktif
        if ($user->email_verified_at) {
            $user->update(['email_verified_at' => null]);
            $pesan = 'Akun pengguna berhasil dinonaktifkan.';
        } else {
            $user->update(['email_verified_at' => now()]);
            $pesan = 'Akun pengguna berhasil diaktifkan.';
        }

        return redirect()->route('admin.users')->with('sukses', $pesan);
    }
}