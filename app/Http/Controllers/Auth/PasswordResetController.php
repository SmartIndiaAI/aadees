<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetController extends Controller
{
    /**
     * Display the password reset request view.
     */
    public function showRequestView($role = 'user')
    {
        return view('auth.passwords.email', ['role' => $role]);
    }

    /**
     * Send rest link to email using broker.
     */
    public function sendResetLink(Request $request, $role = 'user')
    {
        $request->validate(['email' => 'required|email']);

        $broker = match($role) {
            'admin' => 'admins',
            'vendor' => 'vendors',
            default => 'users',
        };

        $status = Password::broker($broker)->sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Display the reset form.
     */
    public function showResetForm($token, $role = 'user', Request $request)
    {
        return view('auth.passwords.reset', [
            'token' => $token,
            'email' => $request->email,
            'role' => $role
        ]);
    }

    /**
     * Perform the actual reset.
     */
    public function reset(Request $request, $role = 'user')
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $broker = match($role) {
            'admin' => 'admins',
            'vendor' => 'vendors',
            default => 'users',
        };

        $status = Password::broker($broker)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route($role . '.login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
