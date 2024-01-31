<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penilaian Guru</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #ddd;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header h1 {
            color: #333;
        }

        .section-title {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .section-content {
            margin-top: 10px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .footer {
            margin-top: 20px;
        }

        /* ... (style sebelumnya) ... */

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature strong {
            display: block;
            margin-top: 20px;
            border-top: 1px solid #333;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Hasil Penilaian Guru</h1>
        </div>

        <div class="section">
            <div class="section-title">Hasil Nilai Terbobot {{ $guru->nama_guru }}</div>
            <div class="section-content">
                <p><strong>NIP:</strong> {{ $guru->nip }}</p>
                <p><strong>Nama Guru:</strong> {{ $guru->nama_guru }}</p>
                <p><strong>Status:</strong> {{ $guru->status }}</p>
                <p><strong>Periode:</strong> {{ $periode ?? 'Tidak ada data' }}</p>
                <h3>Nilai untuk Setiap Kriteria</h3>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiSebelumHitung as $kriteriaId => $nilai)
                            <tr>
                                <td>{{ $dataKriteria->find($kriteriaId)->nama_kriteria }}</td>
                                <td>{{ $nilai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p><strong>Nilai Terbobot:</strong> {{ number_format(floatval($nilaiTerbobot), 2) }}</p>
            </div>
        </div>
    </div>

    <div class="signature" style="text-align: left">
        <p><strong>Kepala Sekolah</strong></p>
        <p style="margin-bottom: 20px"><strong>SD Negeri Pasirhalang</strong></p>
        <!-- Tambahkan isian tanda tangan atau nama kepala sekolah di bawah ini -->
        <p><strong>(Yuniarti, S.Pd)</strong></p>
    </div>

    <div class="footer">
        <p>Laporan Hasil Penilaian Guru SD Negeri Pasirhalang Periode {{ $periode ?? 'Tidan ada data' }}.</p>
    </div>
    </div>
</body>

</html>
