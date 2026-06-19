<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Agent;
use Illuminate\Validation\Rules\Password;


class AuthController extends Controller
{
    public function tampil_login()
    {
        if (Auth::guard('web')->check()) {

            return $this->redirectByRole(
                Auth::guard('web')->user()->role
            );
        }

        if (Auth::guard('pelamar')->check()) {

            return redirect()
                ->route('pelamar.dashboard');
        }

        return view('Auth.Login');
    }

    public function proses_login(Request $request)
    {
        $request->validate([

            'username' => 'required|string',
            'password' => 'required|min:6',

        ]);

        $credentials = $request->only(
            'username',
            'password'
        );

        $agent = new Agent();

        // ==========================
        // LOGIN ADMIN / USER
        // ==========================

        if (Auth::guard('web')->attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::guard('web')->user();

            LoginLog::create([

                'user_id' => $user->id,

                'ip_address' => $request->ip(),

                'device' =>
                $agent->platform() . ' - ' .
                    ($agent->device() ?: 'Desktop'),

                'browser' =>
                $agent->browser(),

                'login_time' => now()

            ]);

            return $this->redirectByRole(
                $user->role
            );
        }

        // ==========================
        // LOGIN PELAMAR
        // ==========================

        $credentialsPelamar = [
            'username'        => $request->username,
            'password'        => $request->password,
            'status_pelamar'  => 'diterima',
        ];

        if (Auth::guard('pelamar')->attempt($credentialsPelamar)) {

            $request->session()->regenerate();

            return redirect()->route('pelamar.dashboard');
        }

        // ==========================
        // LOGIN GAGAL
        // ==========================

        throw ValidationException::withMessages([

            'username' =>
            'Username atau password salah'

        ]);
    }

    public function logout(Request $request)
    {
        // ==========================
        // UPDATE LOGOUT ADMIN
        // ==========================

        if (Auth::guard('web')->check()) {

            $userId = Auth::guard('web')
                ->user()
                ->id;

            $log = LoginLog::where(
                'user_id',
                $userId
            )
                ->latest()
                ->first();

            if ($log && !$log->logout_time) {

                $log->update([

                    'logout_time' => now()

                ]);
            }

            Auth::guard('web')->logout();
        }

        // ==========================
        // LOGOUT PELAMAR
        // ==========================

        if (Auth::guard('pelamar')->check()) {

            Auth::guard('pelamar')->logout();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login');
    }

    private function redirectByRole($role)
    {
        switch ($role) {

            case 'IT':
                return redirect()
                    ->route('dashboard');

            case 'SDM':
                return redirect()
                    ->route('sdm.dashboard');

            default:
                return $this->logoutAndFail();
        }
    }

    private function logoutAndFail()
    {
        Auth::guard('web')->logout();

        throw ValidationException::withMessages([

            'username' =>
            'Role tidak dikenali'

        ]);
    }
    /**
     * Tampilkan halaman profile & ganti password admin.
     */
    public function profile()
    {
        $user = User::with('rumahSakit')
            ->findOrFail(Auth::id());

        return view(
            'IT.profile',
            compact('user')
        );
    }

    public function updatePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([

            'current_password' => [
                'required',
                'string'
            ],

            'password' => [

                'required',
                'confirmed',

                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->uncompromised(),

            ],

        ]);

        if (
            ! Hash::check(
                $request->current_password,
                $user->password
            )
        ) {

            return back()
                ->withErrors([
                    'current_password' =>
                    'Password saat ini tidak sesuai.'
                ])
                ->withInput();
        }

        if (
            Hash::check(
                $request->password,
                $user->password
            )
        ) {

            return back()
                ->withErrors([
                    'password' =>
                    'Password baru tidak boleh sama dengan password lama.'
                ])
                ->withInput();
        }

        $user->update([

            'password' =>
            Hash::make(
                $request->password
            ),

        ]);

        return back()->with(
            'success',
            'Password berhasil diperbarui.'
        );
    }
}
