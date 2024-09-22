<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::all();
        return view('admin.pasien.index', ['pasien' => $pasien]);
    }

    public function create()
    {
        return view('admin.pasien.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama_pasien' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'numeric', 'unique:pasien'],
            'telp' => ['required', 'numeric'],
            'jenis_pasien' => ['required'],
            'jenis_periksa' => ['required'],
            'tgl_periksa' => ['required', 'date'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        Pasien::create($data);

        return redirect()->route('pasien.index')->with('notif', 'Pasien berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('admin.pasien.edit', ['pasien' => $pasien]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama_pasien' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'numeric', 'unique:pasien,nik,' . $id],
            'telp' => ['required', 'numeric'],
            'jenis_pasien' => ['required'],
            'jenis_periksa' => ['required'],
            'tgl_periksa' => ['required', 'date'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $pasien = Pasien::findOrFail($id);
        $pasien->update($data);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil dihapus');
    }
}
