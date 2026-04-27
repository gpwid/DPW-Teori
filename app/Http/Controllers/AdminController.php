<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $user = DB::table('accounts')->where('email', $email)->first();

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
        if (session('admin_logged_in') !== true) {
            return redirect()->route('admin.login');
        }

        $total_tamu = DB::table('guests')->count();
        $rsvp_dikirim = DB::table('guests')->where('status_hadir', '!=', 'PENDING')->count();
        $undangan_pending = DB::table('guests')->where('status_hadir', 'PENDING')->count();
        $recent_guests = DB::table('guests')->orderBy('id', 'desc')->take(5)->get();

        return view('dashboard.index', compact('total_tamu', 'rsvp_dikirim', 'undangan_pending', 'recent_guests'));
    }

    public function konten()
    {
        if (session('admin_logged_in') !== true) {
            return redirect()->route('admin.login');
        }

        $settings = DB::table('settings')->pluck('value', 'key')->toArray();
        return view('dashboard.konten', compact('settings'));
    }

    public function updateKonten(Request $request)
    {
        if (session('admin_logged_in') !== true) {
            return redirect()->route('admin.login');
        }

        $data = $request->except(['_token', 'foto_pria', 'foto_wanita', 'foto_cover']);

        foreach ($data as $key => $value) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value, 'updated_at' => now()]
            );
        }

        // Handle file uploads
        $files = ['foto_pria', 'foto_wanita', 'foto_cover'];
        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $path = $request->file($fileKey)->store('images', 'public');
                DB::table('settings')->updateOrInsert(
                    ['key' => $fileKey],
                    ['value' => 'storage/' . $path, 'updated_at' => now()]
                );
            }
        }

        return redirect()->route('admin.konten')->with('success', 'Konten berhasil diperbarui!');
    }

    public function tamu()
    {
        if (session('admin_logged_in') !== true) {
            return redirect()->route('admin.login');
        }

        $guests = DB::table('guests')->orderBy('id', 'desc')->get();
        return view('dashboard.tamu', compact('guests'));
    }

    public function galeri()
    {
        if (session('admin_logged_in') !== true) {
            return redirect()->route('admin.login');
        }

        $galleries = DB::table('galleries')->orderBy('id', 'asc')->get();
        return view('dashboard.galeri', compact('galleries'));
    }

    public function uploadGaleri(Request $request)
    {
        if (session('admin_logged_in') !== true) {
            return redirect()->route('admin.login');
        }

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('galleries', 'public');
            DB::table('galleries')->insert([
                'image_path' => 'storage/' . $path,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return redirect()->route('admin.galeri')->with('success', 'Foto berhasil diunggah!');
    }

    public function updateGaleri(Request $request, $id)
    {
        if (session('admin_logged_in') !== true) {
            return redirect()->route('admin.login');
        }

        if ($request->hasFile('foto')) {
            $gallery = DB::table('galleries')->where('id', $id)->first();
            if ($gallery) {
                $filePath = str_replace('storage/', '', $gallery->image_path);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($filePath);

                $path = $request->file('foto')->store('galleries', 'public');
                DB::table('galleries')->where('id', $id)->update([
                    'image_path' => 'storage/' . $path,
                    'updated_at' => now()
                ]);
            }
        }

        return redirect()->route('admin.galeri')->with('success', 'Foto berhasil diperbarui!');
    }

    public function deleteGaleri($id)
    {
        if (session('admin_logged_in') !== true) {
            return redirect()->route('admin.login');
        }

        $gallery = DB::table('galleries')->where('id', $id)->first();
        if ($gallery) {
            // Hapus file fisik jika menggunakan Storage (optional tapi disarankan)
            $filePath = str_replace('storage/', '', $gallery->image_path);
            \Illuminate\Support\Facades\Storage::disk('public')->delete($filePath);

            DB::table('galleries')->where('id', $id)->delete();
        }

        return redirect()->route('admin.galeri')->with('success', 'Foto berhasil dihapus!');
    }

    public function dashboardAction(Request $request)
    {
        if (session('admin_logged_in') !== true) {
            return redirect()->route('admin.login');
        }

        $action = $request->input('action');

        if ($action === 'delete') {
            DB::table('guests')->where('id', $request->input('id'))->delete();
        } elseif ($action === 'add') {
            DB::table('guests')->insert([
                'nama' => $request->input('nama', ''),
                'status_hadir' => $request->input('status_hadir', 'PENDING'),
                'plusone' => $request->input('plusone', 0),
                'link_undangan' => $request->input('link_undangan', '')
            ]);
        } elseif ($action === 'edit') {
            DB::table('guests')->where('id', $request->input('id'))->update([
                'nama' => $request->input('nama', ''),
                'status_hadir' => $request->input('status_hadir', 'PENDING'),
                'plusone' => $request->input('plusone', 0),
                'link_undangan' => $request->input('link_undangan', '')
            ]);
        }

        return redirect()->route('admin.tamu');
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_name']);
        return redirect()->route('admin.login');
    }
}
