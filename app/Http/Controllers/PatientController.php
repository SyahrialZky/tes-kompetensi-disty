<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Index: List all patients
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    // Create: Show form to create a new patient
    public function create()
    {
        return view('patients.create');
    }

    // Store: Save new patient
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'no_telp' => 'required|string',
            'email' => 'required|string',
            'keluhan' => 'required|string'
        ]);

        // Buat pasien baru dengan tagihan awal 0
        $patient = Patient::create([
            'name' => $validateData['name'],
            'date_of_birth' => $validateData['date_of_birth'],
            'gender' => $validateData['gender'],
            'no_telp' => $validateData['no_telp'],
            'email' => $validateData['email'],
            'keluhan' => $validateData['keluhan'],
            'tagihan' => 0, // Tagihan awal
        ]);

        // Setelah pasien dibuat, update tagihan (jika ada pemeriksaan terkait)
        $this->updatePatientBill($patient);

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    // Show: View a specific patient
    public function show(Patient $patient)
    {
        $totalBill = 0;

        // Ambil semua pemeriksaan dari pasien
        $examinations = $patient->examinations;

        foreach ($examinations as $examination) {
            $tarif = $examination->tarif;
            $tarifSetelahDiskon = $tarif; // Set tarif awal

            $jenisPemeriksaan = $examination->category->name;

            // Aturan diskon untuk BPJS
            if ($jenisPemeriksaan === 'BPJS' && $tarif >= 500000) {
                $tarifSetelahDiskon *= 0.4; // Diskon 60%
            }
            // Aturan diskon untuk Umum
            elseif ($jenisPemeriksaan === 'Umum' && $tarif < 500000) {
                $tarifSetelahDiskon *= 0.9; // Diskon 10%
            }

            // Tambahkan tarif setelah diskon ke total tagihan
            $totalBill += $tarifSetelahDiskon;
        }

        // Simpan total tagihan ke field 'tagihan' di database
        $patient->update(['tagihan' => $totalBill]);

        return view('patients.detail', compact('patient'));
    }


    // Edit: Show form to edit an existing patient
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    // Update: Save changes to an existing patient
    public function update(Request $request, Patient $patient)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'no_telp' => 'required|string',
            'email' => 'required|string',
            'keluhan' => 'required|string'
        ]);

        // Update data pasien
        $patient->update([
            'name' => $validateData['name'],
            'date_of_birth' => $validateData['date_of_birth'],
            'gender' => $validateData['gender'],
            'no_telp' => $validateData['no_telp'],
            'email' => $validateData['email'],
            'keluhan' => $validateData['keluhan'],

        ]);

        // Update tagihan pasien setelah update data (jika ada perubahan pada pemeriksaan)
        $this->updatePatientBill($patient);

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil diperbarui');
    }

    // Destroy: Delete a patient
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil dihapus');
    }

    /**
     * Update tagihan pasien berdasarkan tarif pemeriksaan.
     * Ini menghitung ulang tagihan pasien dan menyimpannya ke dalam field `tagihan`.
     */
    private function updatePatientBill(Patient $patient)
    {
        $totalBill = 0;

        // Ambil semua pemeriksaan dari pasien
        $examinations = $patient->examinations;

        foreach ($examinations as $examination) {
            $tarif = $examination->tarif;
            $jenisPemeriksaan = $examination->category->name; // Kategori BPJS atau Umum

            // Aturan diskon untuk BPJS
            if ($jenisPemeriksaan === 'BPJS' && $tarif >= 500000) {
                $tarif *= 0.4; // Diskon 60%
            }
            // Aturan diskon untuk Umum
            elseif ($jenisPemeriksaan === 'Umum' && $tarif < 500000) {
                $tarif *= 0.9; // Diskon 10%
            }

            // Tambahkan tarif (setelah diskon jika ada) ke total tagihan
            $totalBill += $tarif;
        }

        // Simpan tagihan di field `tagihan` pasien
        $patient->update(['tagihan' => $totalBill]);
    }
    // Function untuk update diagnosa pasien
    public function updateDiagnosa(Request $request, $id)
    {
        // Validasi input diagnosa
        $request->validate([
            'diagnosa' => 'required|string',
        ]);

        // Cari pasien berdasarkan ID
        $patient = Patient::findOrFail($id);

        // Update diagnosa pasien
        $patient->update([
            'diagnosa' => $request->input('diagnosa'),
        ]);

        // Redirect kembali ke halaman detail pasien dengan pesan sukses
        return redirect()->back()->with('success', 'Diagnosa berhasil diperbarui');
    }
}
