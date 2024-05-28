@extends('layouts.main')

@section('judul', 'Tambah Data Guru')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg">
                <div class="card mt-4">
                    <div class="container">
                        <form class="form-control mt-4 mb-4" action="{{ url('/guru') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                                    id="nip" value="{{ old('nip') }}">
                            </div>
                            @error('nip')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Guru</label>
                                <input type="text" name="nama_guru"
                                    class="form-control @error('nama_guru') is-invalid @enderror" id="nama" value="{{ old('nama_guru') }}">
                            </div>
                            @error('nama_guru')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option value="Guru Mapel">Guru Mapel</option>
                                    <option selected value="Guru Kelas">Guru Kelas</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                    <input type="text" name="keterangan"
                                    class="form-control @error('keterangan') is-invalid @enderror" id="nama" value="{{ old('keterangan') }}">
                            </div>
                            <br>
                            <a href="{{ url('/guru') }}" class="btn btn-secondary"><i
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
