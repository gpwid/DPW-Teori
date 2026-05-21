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

    public function exportCsv()
    {
        $guests = Guest::orderBy('id', 'desc')->get();

        $filename = "daftar_tamu_" . date('Y-m-d_H-i-s') . ".csv";

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=\"{$filename}\"",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Nama', 'Status Hadir', 'Ucapan', 'Plus One', 'Link Undangan'];

        $callback = function() use ($guests, $columns) {
            $file = fopen('php://output', 'w');

            // UTF-8 BOM to support Unicode characters in Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, $columns, ',');

            foreach ($guests as $guest) {
                fputcsv($file, [
                    $guest->id,
                    $guest->nama,
                    $guest->status_hadir,
                    $guest->ucapan ?? '',
                    $guest->plusone,
                    $guest->link_undangan ?? ''
                ], ',');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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
