@extends('layouts.main')

@section('judul', 'Input Penilaian Guru')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg">
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
                                                        <option value="50">Kurang</option>
                                                        <option value="70">Cukup</option>
                                                        <option value="90">Baik</option>
                                                    </select>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary float-end">Simpan dan Hitung Nilai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
