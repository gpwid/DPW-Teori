<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('dashboard.konten', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token', '_method', 'foto_pria', 'foto_wanita', 'foto_cover']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Handle file uploads
        $files = ['foto_pria', 'foto_wanita', 'foto_cover'];
        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $path = $request->file($fileKey)->store('images', 'public');
                Setting::updateOrCreate(
                    ['key' => $fileKey],
                    ['value' => 'storage/' . $path]
                );
            }
        }

        return redirect()->route('settings.index')->with('success', 'Konten berhasil diperbarui!');
    }
}
