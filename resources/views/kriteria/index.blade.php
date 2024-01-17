@extends('layouts.main')

@section('judul', 'Data Kriteria')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ url('/kriteria/create') }}" class="btn btn-primary mt-4"><i
                                    class="ri-add-circle-fill"></i><span> Tambah Kriteria</span></a>
                            <br><br>
                        @endif
                        @if (session('flash_add'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ session('flash_add') }}
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
                        @elseif(session('flash_error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ session('flash_error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <!-- Default Table -->
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Kriteria</th>
                                    <th scope="col">Jenis Kriteria</th>
                                    <th scope="col">Bobot Kriteria</th>
                                    @if (Auth::user()->role == 'admin')
                                        <th scope="col">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $kriteria)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $kriteria->nama_kriteria }}</td>
                                        <td>{{ $kriteria->jenis_kriteria }}</td>
                                        <td>{{ $kriteria->bobot_kriteria }}</td>
                                        @if (Auth::user()->role == 'admin')
                                            <td>
                                                <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#edit-{{ $kriteria->id }}"><i
                                                        class="bx bxs-edit"></i></a>
                                                <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#delete-{{ $kriteria->id }}"><i
                                                        class="bx bx-trash"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @foreach ($data as $kriteria)
                            <!-- Modal Edit -->
                            <div class="modal fade" id="edit-{{ $kriteria->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Kriteria</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-control mt-4 mb-4"
                                                action="{{ url('/kriteria/' . $kriteria->id) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                                                    <input type="text" name="nama_kriteria" class="form-control"
                                                        id="nama_kriteria" value="{{ $kriteria->nama_kriteria }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Kriteria</label>
                                                    <select class="form-select" name="jenis_kriteria"
                                                        aria-label="Default select example">
                                                        <option selected>{{ $kriteria->jenis_kriteria }}</option>
                                                        <option value="Benefit">Benefit</option>
                                                        <option value="Cost">Cost</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bobot_kriteria" class="form-label">Bobot Kriteria <p
                                                            style="font-size: smaller;font-style: italic"> (Isi
                                                            Bobot Kriteria dari 1 - 100 dan Jumlah Keseluruhan Bobot
                                                            Kriteria Tidak Boleh lebih
                                                            dari 100)</p></label>
                                                    <input type="text" name="bobot_kriteria" class="form-control"
                                                        id="bobot_kriteria" value="{{ $kriteria->bobot_kriteria }}">
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
                                                        <div class="alert alert-danger alert-dismissible fade show"
                                                            role="alert">
                                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                                            Jumlah bobot kriteria tidak boleh melebihi 100.
                                                        </div>
                                                    @endif
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

                        @foreach ($data as $kriteria)
                            <!-- Modal Delete -->
                            <div class="modal fade" id="delete-{{ $kriteria->id }}" data-bs-backdrop="static"
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
                                            Apakah Yakin {{ $kriteria->nama_kriteria }} akan di Hapus ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tidak</button>
                                            <a href="{{ url('/delete/kriteria/' . $kriteria->id) }}" type="button"
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
