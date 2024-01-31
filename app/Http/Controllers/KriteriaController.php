<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kriteria::all();
        return view('kriteria.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function validateBobot($newBobot)
    {
        // mengambil total bobot kriteria yang sudah ada
        $totalBobot = Kriteria::sum('bobot_kriteria');

        // menambahkan bobot baru ke total
        $totalBobot += $newBobot;

        // memeriksan apakah total bobot tidak melebihi 100
        return $totalBobot <= 100;
    }
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama_kriteria' => 'required|regex:/^[a-zA-Z ]+$/',
                'jenis_kriteria' => 'required',
                'bobot_kriteria' => 'required|numeric|min:1|max:100'
            ],
            [
                'nama_kriteria.regex' => 'Nama kriteria tidak boleh mengandung angka atau simbol',
                'nama_kriteria.required' => 'Nama kriteria harus diisi',
                'bobot_kriteria.required' => 'Bobot Kriteria harus di isi'
            ]
        );

        if ($this->validateBobot($request->input('bobot_kriteria'))) {
            Kriteria::create([
                'nama_kriteria' => $request->input('nama_kriteria'),
                'jenis_kriteria' => $request->jenis_kriteria,
                'bobot_kriteria' => $request->input('bobot_kriteria')
            ]);

            return redirect('/kriteria')->with('flash_add', 'Kriteria Berhasil Ditambahkan');
        } else {
            return redirect('/kriteria/create')->with('flash_error', 'Jumlah bobot kriteria tidak boleh melebihi 100, Silahkan Cek Kembali');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $this->validate(
                $request,
                [
                    'nama_kriteria' => 'required|regex:/^[a-zA-Z ]+$/',
                    'jenis_kriteria' => 'required',
                    'bobot_kriteria' => 'required|numeric|min:1|max:100'
                ],
                [
                    'nama_kriteria.regex' => 'Nama kriteria tidak boleh mengandung angka atau simbol',
                    'nama_kriteria.required' => 'Nama kriteria harus diisi',
                    'bobot_kriteria.required' => 'Bobot Kriteria harus di isi'
                ]
            );

            // Mendapatkan bobot kriteria yang sudah ada
            $existingBobot = Kriteria::where(['id' => $id])->value('bobot_kriteria');

            // Mendapatkan selisih antara bobot yang baru dan yang sudah ada
            $bobotDifference = $request->input('bobot_kriteria') - $existingBobot;

            if ($this->validateBobot($bobotDifference)) {
                Kriteria::where(['id' => $id])->update([
                    'nama_kriteria' => $request->input('nama_kriteria'),
                    'jenis_kriteria' => $request->jenis_kriteria,
                    'bobot_kriteria' => $request->input('bobot_kriteria')
                ]);

                return redirect()->back()->with('flash_edit', 'Data Kriteria Berhasil di Update');
            } else {
                return redirect()->back()->with('flash_error', 'Jumlah bobot kriteria tidak boleh melebihi 100, Silahkan Cek Kembali');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kriteria::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_delete', 'Data Kriteria Berhasil di Hapus');
    }
}
