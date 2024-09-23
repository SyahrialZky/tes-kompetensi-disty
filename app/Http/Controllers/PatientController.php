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
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    // Show: View a specific patient
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    // Edit: Show form to edit an existing patient
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    // Update: Save changes to an existing patient
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil diperbarui');
    }

    // Destroy: Delete a patient
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil dihapus');
    }
}
