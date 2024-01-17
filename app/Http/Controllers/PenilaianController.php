<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Models\NilaiTerbobot;

class PenilaianController extends Controller
{
    public function index()
    {
        $dataGuru = Guru::with(['penilaian' => function ($query) {
            $query->where('periode', date('Y'));
        }, 'penilaian.kriteria'])->get();

        $allGuru = Guru::all();
        $dataKriteria = Kriteria::all();

        return view('penilaian.index', compact('dataGuru', 'allGuru', 'dataKriteria'));
    }

    public function hitungMatriksNormalisasi($matriksNilai)
    {
        // Matriks normalisasi
        $matriksNormalisasi = [];

        // Matriks nilai maksimum dan minimum
        $matriksMax = [];
        $matriksMin = [];

        // Inisialisasi matriks nilai maksimum dan minimum
        foreach ($matriksNilai as $guruId => $kriteriaSet) {
            foreach ($kriteriaSet as $kriteriaId => $nilai) {
                if (!isset($matriksMax[$kriteriaId]) || $nilai > $matriksMax[$kriteriaId]) {
                    $matriksMax[$kriteriaId] = $nilai;
                }

                if (!isset($matriksMin[$kriteriaId]) || $nilai < $matriksMin[$kriteriaId]) {
                    $matriksMin[$kriteriaId] = $nilai;
                }
            }
        }

        // Hitung matriks normalisasi
        foreach ($matriksNilai as $guruId => $kriteriaSet) {
            foreach ($kriteriaSet as $kriteriaId => $nilai) {
                $kriteria = Kriteria::find($kriteriaId);

                // Hitung normalisasi berdasarkan jenis kriteria
                if ($kriteria->jenis_kriteria == 'Benefit') {
                    $matriksNormalisasi[$guruId][$kriteriaId] = ($matriksMax[$kriteriaId] == 0) ? 0 : $nilai / $matriksMax[$kriteriaId];
                } else {
                    $matriksNormalisasi[$guruId][$kriteriaId] = ($matriksMin[$kriteriaId] == 0) ? 0 : $matriksMin[$kriteriaId] / $nilai;
                }
            }
        }

        return $matriksNormalisasi;
    }

    public function hitungNilaiTerbobot($matriksNormalisasi, $dataKriteria)
    {
        $nilaiTerbobot = [];

        // Iterasi melalui setiap guru
        foreach ($matriksNormalisasi as $guruId => $kriteriaSet) {
            $totalNilaiTerbobot = 0;

            // Iterasi melalui setiap kriteria
            foreach ($kriteriaSet as $kriteriaId => $normalisasi) {
                $kriteria = $dataKriteria->find($kriteriaId);

                // Hitung nilai terbobot untuk setiap kriteria
                $nilaiTerbobotKriteria = $normalisasi * $kriteria->bobot_kriteria;

                // Akumulasikan nilai terbobot untuk setiap kriteria
                $totalNilaiTerbobot += $nilaiTerbobotKriteria;
            }

            // Simpan total nilai terbobot untuk guru tertentu
            $nilaiTerbobot[$guruId] = $totalNilaiTerbobot;
        }

        return $nilaiTerbobot;
    }

    public function store(Request $request)
    {
        // Validasi formulir
        $request->validate([
            'periode' => 'required|numeric',
            'nilai.*.*' => 'required|numeric|min:1|max:100',
        ]);
        // dd($request->all());
        // Matriks nilai
        $matriksNilai = $request->nilai;
        // dd($matriksNilai);

        // ambil data guru
        $allGuru = Guru::all();

        // Ambil data kriteria
        $dataKriteria = Kriteria::all();

        // hitung matriks normalisasi
        $matriksNormalisasi = $this->hitungMatriksNormalisasi($matriksNilai);
        // hitung nilai terbobot
        $nilaiTerbobotResult = $this->hitungNilaiTerbobot($matriksNormalisasi, $dataKriteria);

        // Simpan nilai terbobot ke dalam tabel nilai_terbobot (atau tabel yang sesuai)
        foreach ($nilaiTerbobotResult as $guruId => $nilaiTerbobot) {
            NilaiTerbobot::updateOrCreate(
                ['guru_id' => $guruId, 'periode' => $request->periode],
                ['nilai_terbobot' => $nilaiTerbobot]
            );
        }

        // Simpan matriks normalisasi ke dalam tabel penilaian
        foreach ($matriksNormalisasi as $guruId => $kriteriaSet) {
            foreach ($kriteriaSet as $kriteriaId => $normalisasi) {
                $nilaiOption = $request->nilai[$guruId][$kriteriaId];
                // Konversi nilai "kurang", "cukup", dan "baik" ke nilai numerik
                switch ($nilaiOption) {
                    case 'Kurang':
                        $nilai = 50;
                        break;
                    case 'Cukup':
                        $nilai = 70;
                        break;
                    case 'Baik':
                        $nilai = 90;
                        break;
                    default:
                        $nilai = 0; // Default jika nilai tidak teridentifikasi
                }
                // dd($nilai);
                Penilaian::create([
                    'guru_id' => $guruId,
                    'kriteria_id' => $kriteriaId,
                    'periode' => $request->periode,
                    'nilai' => $nilai,
                    'normalisasi' => $normalisasi,
                ]);
            }
        }

        return view('penilaian.hasil_perhitungan')->with([
            'dataNormalisasi' => $matriksNormalisasi,
            'dataTerbobot' => $nilaiTerbobotResult,
            'dataKriteria' => $dataKriteria,
            'allGuru' => $allGuru
        ]);
    }
}
