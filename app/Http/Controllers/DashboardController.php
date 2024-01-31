<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah data guru
        $jumlahGuru = Guru::count();

        // Hitung jumlah kriteria
        $jumlahKriteria = Kriteria::count();
        $jumlahUser = User::count();

        $periode = date('Y');


        // Ambil hasil penilaian dari masing-masing guru berdasarkan periode
        $hasilPenilaian = Penilaian::where('periode', $periode)->groupBy('guru_id')
            ->selectRaw('guru_id, AVG(nilai) as rataNilai')
            ->with('guru')
            ->get();

        return view('/dashboard', compact('jumlahGuru', 'jumlahKriteria', 'hasilPenilaian', 'jumlahUser'));
    }
}
