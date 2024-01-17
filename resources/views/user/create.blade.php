@extends('layouts.main')

@section('judul', 'Tambah Data User')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg">
                <div class="card mt-4">
                    <div class="container">
                        <form class="form-control mt-4 mb-4" action="{{ url('/user') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" name="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                    value="{{ old('password') }}">
                            </div>
                            @error('password')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select" name="role" aria-label="Default select example">
                                    <option value="admin">admin</option>
                                    <option selected value="kepala_sekolah">kepala_sekolah</option>
                                </select>
                            </div>
                            <br>
                            <a href="{{ url('/user') }}" class="btn btn-secondary"><i
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
