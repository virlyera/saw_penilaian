@extends('layouts.main')

@section('judul', 'Input Penilaian Guru')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Skala Nilai</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nilai</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Kurang</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Cukup</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Baik</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Sangat Baik</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="container mb-4">
                        <form action="{{ route('penilaian.store') }}" method="post">
                            @csrf
                            <div class="mt-4 mb-3 mx-4">
                                <label for="periode" class="form-label">Pilih Periode</label>
                                <select class="form-select" id="periode" name="periode">
                                    @for ($tahun = date('Y'); $tahun >= 1990; $tahun--)
                                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endfor
                                </select>
                            </div>
                            <table class="table mt-4 ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th scope="coll">Nama Guru</th>
                                        @foreach ($dataKriteria as $kriteria)
                                            <th scope="coll">{{ $kriteria->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataGuru as $guru)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $guru->nama_guru }}</td>
                                            @foreach ($dataKriteria as $kriteria)
                                                <td>
                                                    <input type="hidden" name="jenis_kriteria[{{ $kriteria->id }}]"
                                                        value="{{ $kriteria->jenis_kriteria }}">
                                                    <select name="nilai[{{ $guru->id }}][{{ $kriteria->id }}]"
                                                        class="form-select" required>
                                                        <option selected></option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary float-end">Hitung Nilai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
