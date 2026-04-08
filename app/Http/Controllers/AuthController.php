<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

    public function login(Request $request)
    {
        $request->validate([
            'role' => 'required|in:admin,siswa',
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($request->role == 'admin') {
            // Login Admin: Username & Password
            $admin = Admin::where('username', $request->username)->first();
            if ($admin && Hash::check($request->password, $admin->password)) {
                Auth::guard('admin')->login($admin);
                return redirect()->route('admin.dashboard');
            }
        } else {
            // Login Siswa: NIS, Username & Password
            $request->validate(['nis' => 'required']);
            $siswa = Siswa::where('nis', $request->nis)
                          ->where('username', $request->username)
                          ->first();
            if ($siswa && Hash::check($request->password, $siswa->password)) {
                Auth::guard('siswa')->login($siswa);
                return redirect()->route('siswa.dashboard');
            }
        }

        return back()->with('error', 'Data login tidak cocok!');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis',
            'username' => 'required|unique:siswas,username',
            'kelas' => 'required',
            'password' => 'required|min:6',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'username' => $request->username,
            'kelas' => $request->kelas,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}