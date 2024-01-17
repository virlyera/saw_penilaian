<!-- resources/views/hasil_perhitungan.blade.php -->

@extends('layouts.main')

@section('judul', 'Hasil Perhitungan')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="container mt-4 mb-4 ">
                        <h3 class="mt-4">Tabel Normalisasi</h3>
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    @foreach ($dataKriteria as $kriteria)
                                        <th>{{ $kriteria->nama_kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataNormalisasi as $guruId => $kriteriaSet)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $allGuru->find($guruId)->nama_guru }}</td>
                                        @foreach ($kriteriaSet as $normalisasi)
                                            <td>{{ number_format($normalisasi, 2) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <h3 class="mt-4">Tabel Nilai Terbobot</h3>
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">Nilai Terbobot</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataTerbobot as $guruId => $nilaiTerbobot)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $allGuru->find($guruId)->nama_guru }}</td>
                                        <td>{{ number_format($nilaiTerbobot, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h3 class="mt-4">Tabel Perangkingan</h3>
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Peringkat Ke</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">Nilai Terbobot</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Urutkan array nilai terbobot dari tertinggi ke terendah
                                arsort($dataTerbobot);
                                ?>
                                @foreach ($dataTerbobot as $guruId => $nilaiTerbobot)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $allGuru->find($guruId)->nama_guru }}</td>
                                        <td>{{ number_format($nilaiTerbobot, 2) }}</td>
                                        <td>
                                            <a href="{{ route('cetak.hasil.penilaian', ['guru_id' => $guruId]) }}"
                                                class="btn btn-success" target="_blank">Cetak</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
