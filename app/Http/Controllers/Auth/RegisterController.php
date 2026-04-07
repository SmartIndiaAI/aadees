<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display the registration view for each role.
     */
    public function showRegistration($role = 'user')
    {
        return view('auth.register', ['role' => $role]);
    }

    /**
     * Create a new account.
     */
    public function register(Request $request, $role = 'user')
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.($role == 'vendor' ? 'vendors' : 'users')],
            'password' => ['required', 'confirmed', 'min:8'],
        ];

        if ($role == 'vendor') {
            $rules['shop_name'] = ['required', 'string', 'max:255'];
        }

        $request->validate($rules);

        if ($role == 'vendor') {
            $user = Vendor::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'shop_name' => $request->shop_name,
                'slug' => Str::slug($request->shop_name),
            ]);
            Auth::guard('vendor')->login($user);
            return redirect()->route('vendor.dashboard');
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Auth::login($user);
            return redirect()->route('home');
        }
    }
}
