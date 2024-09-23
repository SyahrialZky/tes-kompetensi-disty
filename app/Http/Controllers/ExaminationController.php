<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\Patient;
use App\Models\Category;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    // Index: List all examinations for a patient
    public function index(Patient $patient)
    {
        $examinations = $patient->examinations;
        return view('examinations.index', compact('examinations', 'patient'));
    }

    // Create: Show form to create a new examination
    public function create(Patient $patient)
    {
        $categories = Category::all();
        return view('examinations.create', compact('patient', 'categories'));
    }

    // Store: Save new examination
    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'results' => 'required|string',
        ]);

        $patient->examinations()->create($request->all());

        return redirect()->route('patients.examinations.index', $patient)->with('success', 'Pemeriksaan berhasil ditambahkan');
    }

    // Show: View a specific examination
    public function show(Examination $examination)
    {
        return view('examinations.show', compact('examination'));
    }

    // Edit: Show form to edit an existing examination
    public function edit(Examination $examination)
    {
        $categories = Category::all();
        return view('examinations.edit', compact('examination', 'categories'));
    }

    // Update: Save changes to an existing examination
    public function update(Request $request, Examination $examination)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'results' => 'required|string',
        ]);

        $examination->update($request->all());

        return redirect()->route('patients.examinations.index', $examination->patient_id)->with('success', 'Pemeriksaan berhasil diperbarui');
    }

    // Destroy: Delete an examination
    public function destroy(Examination $examination)
    {
        $examination->delete();

        return redirect()->route('patients.examinations.index', $examination->patient_id)->with('success', 'Pemeriksaan berhasil dihapus');
    }
}
