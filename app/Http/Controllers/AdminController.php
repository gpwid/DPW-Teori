<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Guest;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in') === true) {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard.login');
    }

    public function processLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = Account::where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user->password) || $password === $user->password) {
                session([
                    'admin_logged_in' => true,
                    'admin_name' => $user->nama
                ]);
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function dashboard()
    {
        $total_tamu = Guest::count();
        $rsvp_dikirim = Guest::where('status_hadir', '!=', 'PENDING')->count();
        $undangan_pending = Guest::where('status_hadir', 'PENDING')->count();
        $recent_guests = Guest::orderBy('id', 'desc')->take(5)->get();

        return view('dashboard.index', compact('total_tamu', 'rsvp_dikirim', 'undangan_pending', 'recent_guests'));
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_name']);
        return redirect()->route('admin.login');
    }
}

