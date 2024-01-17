<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Svg\Tag\Circle;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:4',
            'role' => 'required'
        ]);

        $validateData['password'] = Hash::make($validateData['password']);
        User::create($validateData);

        return redirect('/user')->with('flash_success', 'Data User Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        User::where(['id' => $id])->update([
            'name' => $data['name'],
            'email' => $data['email'],
            // 'password' => $data['password'],
            'role' => $data['role']
        ]);

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        User::where(['id' => $id])->update($updateData);

        return redirect()->back()->with('flash_edit', 'Data User Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_delete', 'Data User Berhasil di Hapus');
    }
}
