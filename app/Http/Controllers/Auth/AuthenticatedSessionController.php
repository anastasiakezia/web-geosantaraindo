<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi user.
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Karena role hanya admin, langsung redirect ke dashboard
            return redirect()->route('admin.dashboard');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Debug log
            Log::info('LOGIN BERHASIL', [
                'user_id' => Auth::id(),
                'session_id' => session()->getId()
            ]);

            // Karena role cuma admin, langsung redirect ke dashboard
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'login' => 'Username atau password salah.',
        ])->onlyInput('username');
    }


    /**
     * Logout user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
