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

    public function exportPdf()
    {
        $guests = Guest::orderBy('id', 'desc')->get();
        $filename = "daftar_tamu_" . date('Y-m-d_H-i-s') . ".pdf";
        $content = $this->buildGuestPdf($guests);

        $headers = [
            "Content-Type" => "application/pdf",
            "Content-Disposition" => "attachment; filename=\"{$filename}\"",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        return response()->streamDownload(function() use ($content) {
            echo $content;
        }, $filename, $headers);
    }

    private function buildGuestPdf($guests)
    {
        $lines = [];
        $lines[] = 'Daftar Tamu';
        $lines[] = 'Tanggal: ' . date('Y-m-d H:i:s');
        $lines[] = '';
        $lines[] = sprintf('%-4s %-30s %-8s %-8s %s', 'ID', 'Nama', 'Status', 'Plus', 'Link');
        $lines[] = str_repeat('-', 90);

        foreach ($guests as $guest) {
            $name = $this->pdfString($guest->nama);
            $link = $guest->link_undangan ? $this->pdfString($guest->link_undangan) : '-';
            $lines[] = sprintf('%-4s %-30s %-8s %-8s %s', $guest->id, $name, $guest->status_hadir, $guest->plusone, $link);
        }

        if ($guests->isEmpty()) {
            $lines[] = 'Tidak ada data tamu.';
        }

        $perPage = 45;
        $pages = array_chunk($lines, $perPage);
        $objects = [];
        $fontObjectNumber = 3;

        foreach ($pages as $pageIndex => $pageLines) {
            $content = "BT /F1 10 Tf 14 TL 50 820 Td ";
            foreach ($pageLines as $lineIndex => $line) {
                if ($lineIndex > 0) {
                    $content .= "T* ";
                }
                $content .= '(' . $line . ') Tj ';
            }
            $content .= 'ET';
            $contentStream = "stream\n{$content}\nendstream";
            $objects[] = [
                'type' => 'content',
                'data' => $contentStream,
                'length' => strlen($content),
            ];
        }

        $pdfObjects = [];
        $pdfObjects[] = "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
        $pdfObjects[] = "2 0 obj\n<< /Type /Pages /Kids [" . implode(' ', array_map(fn($pageIndex) => (5 + $pageIndex * 2) . ' 0 R', array_keys($objects))) . "] /Count " . count($objects) . " >>\nendobj\n";
        $pdfObjects[] = "{$fontObjectNumber} 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n";

        foreach ($objects as $index => $obj) {
            $contentObjectNumber = 4 + $index * 2;
            $pageObjectNumber = $contentObjectNumber + 1;
            $pdfObjects[] = "{$contentObjectNumber} 0 obj\n<< /Length {$obj['length']} >>\n{$obj['data']}\nendobj\n";
            $pdfObjects[] = "{$pageObjectNumber} 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 {$fontObjectNumber} 0 R >> >> /Contents {$contentObjectNumber} 0 R >>\nendobj\n";
        }

        $pdf = "%PDF-1.4\n";
        $offsets = [0 => '0000000000'];

        foreach ($pdfObjects as $obj) {
            $offsets[] = str_pad(strlen($pdf), 10, '0', STR_PAD_LEFT);
            $pdf .= $obj;
        }

        $xrefPosition = strlen($pdf);
        $pdf .= "xref\n0 " . (count($pdfObjects) + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";
        foreach (array_slice($offsets, 1) as $offset) {
            $pdf .= "{$offset} 00000 n \n";
        }

        $pdf .= "trailer\n<< /Size " . (count($pdfObjects) + 1) . " /Root 1 0 R >>\nstartxref\n{$xrefPosition}\n%%EOF";

        return $pdf;
    }

    private function pdfString($text)
    {
        $text = trim($text);
        $converted = @iconv('UTF-8', 'CP1252//TRANSLIT', $text);
        if ($converted !== false) {
            $text = $converted;
        }
        return str_replace(['\\', '(', ')'], ['\\\\', '\(', '\)'], $text);
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
