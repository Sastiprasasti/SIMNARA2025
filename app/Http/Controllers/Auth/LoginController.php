<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // dd('Login berhasil', Auth::user());

            \Log::info('Login berhasil. Data user:', [
                'email' => auth()->user()->email,
                'role' => auth()->user()->role,
                'is_admin' => auth()->user()->isAdmin(),
            ]);

            // if (auth()->user()->isAdmin()) {
            //     return redirect()->route('admin.dashboard');
            // }
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        \Log::warning('Login gagal: ' . $request->email);

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // return redirect('/');

        return redirect('/')->withCookie(cookie()->forget(config('session.cookie')));
    }
}
