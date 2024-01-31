<?php

namespace App\Http\Controllers;

use TCPDF;
use App\Models\Guru;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Models\NilaiTerbobot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class CetakController extends Controller
{
    public function cetakHasilPenilaian($guru_id)
    {
        $guru = Guru::findOrFail($guru_id);
        $dataKriteria = Kriteria::all();

        // $nilaiTerbobot = NilaiTerbobot::where('guru_id', $guru_id)->get();
        // $periode = NilaiTerbobot::where('guru_id', $guru_id)->value('periode');
        // $nilaiTerbobot = DB::table('nilai_terbobot')
        // ->where('guru_id', $guru_id) 
        // ->pluck('nilai_terbobot')
        // ->toArray();
        $periode = DB::table('nilai_terbobot')
            ->where('guru_id', $guru_id)
            ->value('periode');

        $nilaiTerbobot = (float) DB::table('nilai_terbobot')
            ->where('guru_id', $guru_id)
            ->where('periode', $periode)
            ->value('nilai_terbobot');
            // dd($nilaiTerbobot);


        $periode = DB::table('nilai_terbobot')
            ->where('guru_id', $guru_id)
            ->value('periode');
        $nilaiSebelumHitung = $this->ambilDataNilaiSebelumHitung($guru_id, $periode);

        $pdf = new TCPDF();
        $pdf->SetAutoPageBreak(true, 10);

        // Mulai pembuatan halaman PDF
        $pdf->AddPage();

        // Tambahkan konten ke halaman PDF
        $html = view('cetak.hasil_penilaian', compact('guru', 'nilaiTerbobot', 'dataKriteria', 'periode', 'nilaiSebelumHitung'))->render();
        $pdf->writeHTML($html, true, false, true, false, '');
        return $pdf->Output('hasil_penilaian' . $guru->nama_guru . '.pdf', 'D');
    }

    private function ambilDataNilaiSebelumHitung($guru_id, $periode)
    {
        // Ambil data penilaian sebelum dihitung berdasarkan guru_id dan periode
        $nilaiSebelumHitung = Penilaian::where('guru_id', $guru_id)
            ->where('periode', $periode)
            ->pluck('nilai', 'kriteria_id')
            ->toArray();

        return $nilaiSebelumHitung;
    }
}
