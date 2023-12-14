@extends('layouts.main')

@section('judul', 'Tambah Kriteria')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg">
                <div class="card mt-4">
                    <div class="container">
                        <form class="form-control mt-4 mb-4" action="{{ url('/kriteria') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                                <input type="text" name="nama_kriteria"
                                    class="form-control @error('nama_kriteria') is-invalid @enderror" id="nip"
                                    value="{{ old('nama_kriteria') }}">
                            </div>
                            @error('nama_kriteria')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label">Jenis Kriteria</label>
                                <select class="form-select" name="jenis_kriteria" aria-label="Default select example">
                                    <option selected value="Benefit">Benefit</option>
                                    <option value="Cost">Cost</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="bobot_kriteria" class="form-label">Bobot Kriteria <p
                                        style="font-size: smaller;font-style: italic"> (Isi
                                        Bobot Kriteria dari 1 - 100 dan Jumlah Keseluruhan Bobot Kriteria Tidak Boleh lebih
                                        dari 100)</p></label>
                                <input type="text" name="bobot_kriteria"
                                    class="form-control @error('bobot_kriteria') is-invalid @enderror" id="bobot_kriteria"
                                    value="{{ old('bobot_kriteria') }}">
                                @php
                                    $data = App\Models\Kriteria::all();
                                    $totalBobot = 0;
                                    foreach ($data as $kriteria) {
                                        $totalBobot += $kriteria->bobot_kriteria;
                                    }
                                    $sisaBobot = 100 - $totalBobot;
                                @endphp
                                <small>Sisa Bobot: {{ $sisaBobot }}</small>
                                @if ($sisaBobot < 0)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        Jumlah bobot kriteria tidak boleh melebihi 100.
                                    </div>
                                @endif
                            </div>
                            @error('bobot_kriteria')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <br>
                            <a href="{{ url('/kriteria') }}" class="btn btn-secondary"><i
                                    class="ri-arrow-go-back-line"></i><span> Batal</span></a>
                            <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i><span>
                                    Simpan</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

        </div>
        </div>
    </section>
@endsection
