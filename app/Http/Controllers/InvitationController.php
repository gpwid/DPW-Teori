<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Gallery;
use App\Models\Guest;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $galleries = Gallery::orderBy('id', 'asc')->get();

        $judul = $settings['landing_page_title'] ?? "The Wedding Of";
        $nama_tamu = "[Nama Tamu]";
        $guest = null;
        
        if ($request->has('to')) {
            $slug = $request->query('to');
            $guest = Guest::all()->first(function($g) use ($slug) {
                return Str::slug($g->nama) === $slug;
            });
            
            $nama_tamu = $guest ? $guest->nama : ucwords(htmlspecialchars(str_replace('-', ' ', $slug)));
        }

        if (empty($nama_tamu)) {
            $nama_tamu = "[Nama Tamu]";
        }

        return view('undangan.index', compact('judul', 'nama_tamu', 'settings', 'galleries', 'guest'));
    }

    public function rsvp(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:128',
            'hadir' => 'required|string',
            'ucapan' => 'required|string|max:255',
            'plusone' => 'nullable|integer|min:0',
        ]);

        $nama = $request->input('nama');
        $hadirInput = $request->input('hadir');
        $ucapan = $request->input('ucapan');
        $plusone = $request->input('plusone', 0);
        $guestId = $request->input('guest_id');

        $status_hadir = 'PENDING';
        $upperHadir = strtoupper($hadirInput);
        if ($upperHadir === 'HADIR') {
            $status_hadir = 'HADIR';
        } elseif ($upperHadir === 'TIDAK' || $upperHadir === 'TIDAK HADIR') {
            $status_hadir = 'TIDAK';
        }

        $guest = null;
        if ($guestId) {
            $guest = Guest::find($guestId);
        }

        if ($guest) {
            $guest->status_hadir = $status_hadir;
            $guest->ucapan = $ucapan;
            $guest->plusone = $plusone;
            $guest->save();
        } else {
            $guest = Guest::create([
                'nama' => $nama,
                'status_hadir' => $status_hadir,
                'ucapan' => $ucapan,
                'plusone' => $plusone,
                'link_undangan' => null
            ]);
        }

        return response()->json([
            'success' => true,
            'nama' => $guest->nama,
            'status_hadir' => $guest->status_hadir,
            'ucapan' => $guest->ucapan,
        ]);
    }
}
