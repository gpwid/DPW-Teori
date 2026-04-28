<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Gallery;

class InvitationController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $galleries = Gallery::orderBy('id', 'asc')->get();

        $judul = "The Wedding Of";
        $nama_tamu = "[Nama Tamu]";
        
        if ($request->has('to')) {
            $nama_tamu = ucwords(htmlspecialchars(str_replace('-', ' ', $request->query('to'))));
        }

        return view('undangan.index', compact('judul', 'nama_tamu', 'settings', 'galleries'));
    }
}
