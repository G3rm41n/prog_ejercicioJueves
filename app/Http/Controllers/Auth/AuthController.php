<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
//use App\Models\LoginAudit;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('username', 'password');
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->except('password'))
                ->withErrors([
                    'username' => 'Username atau password tidak valid.',
                ]);
        }

        $request->session()->regenerate();
        $user = Auth::user();

        // Objetivo 2: registrar el acceso exitoso en la tabla login_audits
        LoginAudit::create([
            'user_id'      => $user->id,           // ID del usuario que ingresó
            'ip_address'   => $request->ip(),      // IP obtenida automáticamente del request HTTP
            'logged_in_at' => now(),               // fecha y hora actual del servidor
        ]);

        return match ($user->role) {
            'admin'    => redirect()->route('admin.dashboard'),
            'hr'       => redirect()->route('hr.dashboard'),
            'employee' => redirect()->route('employee.dashboard'),
            default    => redirect()->route('login'),
        };
    }

    /**
     * Logout pengguna.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
