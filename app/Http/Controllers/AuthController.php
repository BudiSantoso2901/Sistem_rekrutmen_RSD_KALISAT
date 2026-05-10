<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;;

class AuthController extends Controller
{
    public function tampil_login()
    {
        if (Auth::guard('web')->check()) {
            return $this->redirectByRole(Auth::guard('web')->user()->role);
        }

        if (Auth::guard('pelamar')->check()) {
            return redirect()->route('pelamar.dashboard');
        }

        return view('Auth.Login');
    }

    public function proses_login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('username', 'password');

        // =====================
        // LOGIN USER (IT / SDM)
        // =====================
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return $this->redirectByRole(Auth::guard('web')->user()->role);
        }

        // =====================
        // LOGIN PELAMAR
        // =====================
        if (Auth::guard('pelamar')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('pelamar.dashboard');
        }

        // =====================
        // GAGAL LOGIN
        // =====================
        throw ValidationException::withMessages([
            'username' => 'Username atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('pelamar')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // 🔥 CENTRAL REDIRECT (biar gak duplikat)
    private function redirectByRole($role)
    {
        return match ($role) {
            'IT' => redirect()->route('dashboard'),
            'SDM' => redirect()->route('sdm.dashboard'),
            'Pelamar' => redirect()->route('pelamar.dashboard'),
            default => $this->logoutAndFail(),
        };
    }

    private function logoutAndFail()
    {
        Auth::logout();

        throw ValidationException::withMessages([
            'username' => 'Role tidak dikenali',
        ]);
    }
}
