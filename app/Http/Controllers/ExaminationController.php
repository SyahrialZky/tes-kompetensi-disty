<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\Patient;
use App\Models\Category;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    // Index: List semua pemeriksaan milik pasien
    public function index(Patient $patient)
    {
        $examinations = $patient->examinations;
        return view('examinations.index', compact('examinations', 'patient'));
    }

    // Create: Show form untuk tambah pemeriksaan (examination)
    public function create(Patient $patient)
    {
        $categories = Category::all();
        return view('examinations.create', compact('patient', 'categories'));
    }

    // Store: Save pemeriksaan baru
    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'results' => 'required|string',
            'tarif' => 'required|numeric',
        ]);

        // Buat pemeriksaan baru
        $examination = $patient->examinations()->create($request->only(['category_id', 'date', 'results', 'tarif']));

        // Update tagihan pasien setelah menambahkan pemeriksaan baru
        $this->updatePatientBill($patient);

        return redirect()->route('examinations.index', $patient)->with('success', 'Pemeriksaan berhasil ditambahkan');
    }

    // Show: Lihat spesifik pemeriksaan (examination)
    public function show(Examination $examination)
    {
        return view('examinations.show', compact('examination'));
    }

    // Edit: Show form untuk edit pemeriksaan
    public function edit(Examination $examination)
    {
        $categories = Category::all();
        return view('examinations.edit', compact('examination', 'categories'));
    }

    // Update: Save perubahan update pemeriksaan
    public function update(Request $request, Examination $examination)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'results' => 'required|string',
            'tarif' => 'required|numeric',
        ]);

        // Update pemeriksaan
        $examination->update($request->only(['category_id', 'date', 'results', 'tarif']));

        // Update tagihan pasien setelah perubahan
        $this->updatePatientBill($examination->patient);

        return redirect()->route('examinations.index', $examination->patient_id)->with('success', 'Pemeriksaan berhasil diperbarui');
    }

    // Destroy: Delete pemeriksaan
    public function destroy(Examination $examination)
    {
        $examination->delete();

        return redirect()->route('examinations.index', $examination->patient_id)->with('success', 'Pemeriksaan berhasil dihapus');
    }
    // Function untuk update tarif pemeriksaan
    private function updatePatientBill(Patient $patient)
    {
        // Ambil semua pemeriksaan pasien
        $examinations = $patient->examinations;

        $totalBill = 0;

        foreach ($examinations as $examination) {
            $tarif = $examination->tarif;

            // Dapatkan jenis kategori pemeriksaan (misal BPJS atau Umum)
            $jenisPemeriksaan = $examination->category->name; // Sesuaikan dengan kategori 'BPJS' atau 'Umum'

            // Aturan diskon untuk BPJS
            if ($jenisPemeriksaan === 'BPJS' && $tarif >= 500000) {
                $tarif = $tarif * 0.4; // Diskon 60%
            }
            // Aturan diskon untuk Umum
            elseif ($jenisPemeriksaan === 'Umum' && $tarif < 500000) {
                $tarif = $tarif * 0.9; // Diskon 10%
            }

            // Tambahkan tarif (setelah diskon) ke total tagihan
            $totalBill += $tarif;
        }

        // Simpan tagihan ke pasien
        $patient->update(['tagihan' => $totalBill]);
    }
    // Function ubah status ditangani / belum 
    public function handle($id)
    {
        // Cari data pemeriksaan berdasarkan ID
        $examination = Examination::findOrFail($id);

        // Ubah status menjadi true (handled)
        $examination->update([
            'status' => true,
        ]);

        // Redirect ke halaman sebelumnya atau ke halaman daftar pemeriksaan dengan pesan sukses
        return redirect()->back()->with('success', 'Pemeriksaan berhasil ditangani.');
    }
}
