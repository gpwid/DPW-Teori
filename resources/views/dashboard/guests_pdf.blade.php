<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Tamu</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; }
        th { background: #f5f5f5; font-weight: bold; }
        .center { text-align: center; }
    </style>
</head>
<body>
    <h2 style="margin-bottom:0.5rem;">Daftar Tamu</h2>
    <p style="margin-top:0; margin-bottom:1rem;">Diunduh: {{ date('Y-m-d H:i:s') }}</p>

    <table>
        <thead>
            <tr>
                <th style="width:5%">ID</th>
                <th>Nama</th>
                <th style="width:12%">Status Hadir</th>
                <th style="width:18%">Ucapan</th>
                <th style="width:8%">Plus One</th>
                <th style="width:20%">Link Undangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $guest)
                <tr>
                    <td class="center">{{ $guest->id }}</td>
                    <td>{{ $guest->nama }}</td>
                    <td class="center">{{ $guest->status_hadir }}</td>
                    <td>{{ $guest->ucapan ?? '-' }}</td>
                    <td class="center">{{ $guest->plusone }}</td>
                    <td>{{ $guest->link_undangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
