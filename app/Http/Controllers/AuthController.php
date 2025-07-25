<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard')->with('success', 'Login berhasil sebagai admin');
            } else {
                return redirect()->intended('/')->with('success', 'Login berhasil');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',

        ]);
    }


    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Simpan ke database dalam transaksi
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            Customer::create([
                'user_id' => $user->id,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            DB::commit();

            // Auto login setelah register (opsional)
            Auth::login($user);

            return redirect()->route('home')->with('success', 'Registrasi berhasil');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['register' => 'Terjadi kesalahan saat registrasi.'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login')->with('success', 'Anda telah berhasil logout.');
    }
}
