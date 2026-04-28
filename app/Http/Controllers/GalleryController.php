<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('id', 'asc')->get();
        return view('dashboard.galeri', compact('galleries'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('galleries', 'public');
            Gallery::create([
                'image_path' => 'storage/' . $path
            ]);
        }

        return redirect()->route('galleries.index')->with('success', 'Foto berhasil diunggah!');
    }

    public function update(Request $request, $id)
    {
        if ($request->hasFile('foto')) {
            $gallery = Gallery::find($id);
            if ($gallery) {
                $filePath = str_replace('storage/', '', $gallery->image_path);
                Storage::disk('public')->delete($filePath);

                $path = $request->file('foto')->store('galleries', 'public');
                $gallery->update([
                    'image_path' => 'storage/' . $path
                ]);
            }
        }

        return redirect()->route('galleries.index')->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        if ($gallery) {
            $filePath = str_replace('storage/', '', $gallery->image_path);
            Storage::disk('public')->delete($filePath);

            $gallery->delete();
        }

        return redirect()->route('galleries.index')->with('success', 'Foto berhasil dihapus!');
    }
}
