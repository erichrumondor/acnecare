<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.profil', compact('user'));
    }
public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'foto'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $fotoPath = $user->foto ?? null;
    if ($request->hasFile('foto')) {
        if ($user->foto) Storage::disk('public')->delete($user->foto);
        $fotoPath = $request->file('foto')->store('profil', 'public');
    }

    \App\Models\User::where('id', $user->id)->update([
        'name'  => $request->name,
        'email' => $request->email,
        'foto'  => $fotoPath,
    ]);

    return redirect()->route('profil')->with('sukses', 'Profil berhasil diperbarui!');
}

public function gantiPassword(Request $request)
{
    $request->validate([
        'password_lama' => 'required',
        'password'      => 'required|min:8|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->password_lama, $user->password)) {
        return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.']);
    }

    \App\Models\User::where('id', $user->id)->update([
        'password' => Hash::make($request->password)
    ]);

    return redirect()->route('profil')->with('sukses', 'Password berhasil diubah!');
}
}