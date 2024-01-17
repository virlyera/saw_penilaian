@extends('layouts.main')

@section('judul', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Guru</h5>
                        <p class="card-text">{{ $jumlahGuru }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Kriteria</h5>
                        <p class="card-text">{{ $jumlahKriteria }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah User</h5>
                        <p class="card-text">{{ $jumlahUser }}</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">SPK Penilaian Guru dengan Metode SAW</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Sistem Pendukung Keputusan (SPK) Penilaian Guru menggunakan metode Simple Additive Weighting (SAW)
                        adalah suatu sistem yang membantu dalam proses pengambilan keputusan terkait penilaian kinerja guru.
                        Metode SAW adalah metode penilaian kinerja dengan memberikan bobot pada setiap kriteria, kemudian
                        menjumlahkan nilai kriteria yang telah dinormalisasi untuk mendapatkan nilai akhir.

                        <strong>Cara Kerja:</strong>
                    <ol>
                        <li>Input nilai kriteria untuk setiap guru.</li>
                        <li>Hitung matriks normalisasi berdasarkan nilai maksimum dan minimum setiap kriteria.</li>
                        <li>Hitung nilai terbobot dengan mengalikan matriks normalisasi dengan bobot kriteria.</li>
                        <li>Simpan nilai terbobot ke dalam tabel nilai terbobot untuk setiap guru.</li>
                        <li>Simpan matriks normalisasi ke dalam tabel penilaian untuk setiap guru dan setiap kriteria.</li>
                        <li>Hitung nilai akhir dengan menjumlahkan nilai terbobot.</li>
                        <li>Hasil penilaian guru tersedia di dashboard, termasuk rata-rata nilai untuk setiap guru.</li>
                    </ol>

                    <strong>Manfaat:</strong>
                    <ul>
                        <li>Memberikan hasil penilaian yang objektif berdasarkan kriteria yang telah ditetapkan.</li>
                        <li>Memudahkan proses pengambilan keputusan terkait peningkatan kinerja guru.</li>
                        <li>Menghasilkan informasi visual seperti grafik untuk memudahkan analisis.</li>
                    </ul>
                    <p class="mt-3 text-muted">
                        Aplikasi berbasis Web ini disusun oleh Susanto (NIM: 352141003) sebagai bagian dari penyelesaian
                        skripsi di STIMIK
                        IM Tahun 2024.
                    </p>
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection
