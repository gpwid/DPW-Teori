<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $guests = Guest::orderBy('id', 'desc')->get();
        return view('dashboard.tamu', compact('guests'));
    }

    public function store(Request $request)
    {
        Guest::create([
            'nama' => $request->input('nama', ''),
            'status_hadir' => $request->input('status_hadir', 'PENDING'),
            'plusone' => $request->input('plusone', 0),
            'link_undangan' => $request->input('link_undangan', '')
        ]);

        return redirect()->route('guests.index')->with('success', 'Tamu berhasil ditambah');
    }

    public function update(Request $request, $id)
    {
        $guest = Guest::find($id);
        if ($guest) {
            $guest->update([
                'nama' => $request->input('nama', ''),
                'status_hadir' => $request->input('status_hadir', 'PENDING'),
                'plusone' => $request->input('plusone', 0),
                'link_undangan' => $request->input('link_undangan', '')
            ]);
        }

        return redirect()->route('guests.index')->with('success', 'Tamu berhasil diedit');
    }

    public function destroy($id)
    {
        $guest = Guest::find($id);
        if ($guest) {
            $guest->delete();
        }

        return redirect()->route('guests.index')->with('success', 'Tamu berhasil dihapus');
    }
}
