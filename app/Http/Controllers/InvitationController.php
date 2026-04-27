<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index(Request $request)
    {
        $settings = \Illuminate\Support\Facades\DB::table('settings')->pluck('value', 'key')->toArray();
        $galleries = \Illuminate\Support\Facades\DB::table('galleries')->orderBy('id', 'asc')->get();

        $judul = "The Wedding Of";
        $nama_tamu = "[Nama Tamu]";
        
        if ($request->has('to')) {
            $nama_tamu = ucwords(htmlspecialchars(str_replace('-', ' ', $request->query('to'))));
        }

        return view('undangan.index', compact('judul', 'nama_tamu', 'settings', 'galleries'));
    }
}
