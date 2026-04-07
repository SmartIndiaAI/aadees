<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Display the login view for each role.
     */
    public function showLogin(Request $request)
    {
        $role = $request->route()->defaults['role'] ?? 'user';
        return view('auth.login', ['role' => $role]);
    }

    /**
     * Handle authentication for all roles.
     */
    public function login(Request $request)
    {
        $role = $request->route()->defaults['role'] ?? 'user';
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $guard = match($role) {
            'admin' => 'admin',
            'vendor' => 'vendor',
            default => 'web',
        };

        if (Auth::guard($guard)->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $redirect = match($role) {
                'admin' => route('admin.dashboard'),
                'vendor' => route('vendor.dashboard'),
                default => route('home'),
            };

            return redirect()->intended($redirect);
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Logout and invalidate session.
     */
    public function logout(Request $request)
    {
        $role = $request->route()->defaults['role'] ?? 'user';
        $guard = match($role) {
            'admin' => 'admin',
            'vendor' => 'vendor',
            default => 'web',
        };

        Auth::guard($guard)->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
