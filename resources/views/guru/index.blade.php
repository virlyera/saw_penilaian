@extends('layouts.main')

@section('judul', 'Data Guru')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/guru/create') }}" class="btn btn-primary mt-4"><i
                                class="ri-add-circle-fill"></i><span> Tambah Guru</span></a>
                        <br><br>
                        @if (session('flash_success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ session('flash_success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif(session('flash_edit'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ session('flash_edit') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif(session('flash_delete'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ session('flash_delete') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <!-- Default Table -->
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $guru)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $guru->nama_guru }}</td>
                                        <td>{{ $guru->nip }}</td>
                                        <td>{{ $guru->status }}</td>
                                        <td>
                                            <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#edit-{{ $guru->id }}"><i
                                                    class="ri-edit-2-fill"></i></a>
                                            {{-- href="{{ url('/delete/guru/' . $guru->id) }}" --}}
                                            <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $guru->id }}"><i
                                                    class="ri-delete-bin-7-fill"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @foreach ($data as $guru)
                            <!-- Modal Edit -->
                            <div class="modal fade" id="edit-{{ $guru->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data Guru</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-control mt-4 mb-4" action="{{ url('/guru/' . $guru->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="nip" class="form-label">NIP</label>
                                                    <input type="text" name="nip"
                                                        class="form-control @error('nip') is-invalid @enderror"
                                                        id="nip" value="{{ $guru->nip }}">
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
                                                        class="form-control @error('nama_guru') is-invalid @enderror"
                                                        id="nama" value="{{ $guru->nama_guru }}">
                                                </div>
                                                @error('nama_guru')
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <select class="form-select" name="status"
                                                        aria-label="Default select example">
                                                        <option selected>{{ $guru->status }}</option>
                                                        <option value="Guru Mapel">Guru Mapel</option>
                                                        <option value="Guru Kelas">Guru Kelas</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                                    class="ri-arrow-go-back-line"></i><span>
                                                    Batal</span></button>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="ri-save-3-fill"></i><span>
                                                    Update</span></button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach ($data as $guru)
                            <!-- Modal Delete -->
                            <div class="modal fade" id="delete-{{ $guru->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Yakin {{ $guru->nama_guru }} akan di Hapus ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tidak</button>
                                            <a href="{{ url('/delete/guru/' . $guru->id) }}" type="button"
                                                class="btn btn-danger">Ya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
