<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MedicalRecordController extends Controller
{
    /**
     * Display a paginated listing of medical records.
     */
    public function index()
    {
        $medicalRecords = MedicalRecord::with(['patient', 'doctor'])->paginate(15);

        return Inertia::render('MedicalRecords/Index', [
            'medicalRecords' => $medicalRecords,
        ]);
    }

    /**
     * Show the form for creating a new medical record.
     */
    public function create()
    {
        // Optionally pass patients and doctors for selection
        // $patients = Patient::all();
        // $doctors = Doctor::all();

        return Inertia::render('MedicalRecords/Create' /*, compact('patients', 'doctors') */);
    }

    /**
     * Store a newly created medical record in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'visit_date' => 'required|date',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        MedicalRecord::create($validated);

        return redirect()->route('medical-records.index')->with('success', 'Medical record created successfully.');
    }

    /**
     * Display the specified medical record.
     */
    public function show(string $id)
    {
        $medicalRecord = MedicalRecord::with(['patient', 'doctor'])->findOrFail($id);

        return Inertia::render('MedicalRecords/Show', [
            'medicalRecord' => $medicalRecord,
        ]);
    }

    /**
     * Show the form for editing the specified medical record.
     */
    public function edit(string $id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);

        // Optionally pass patients and doctors for selection
        // $patients = Patient::all();
        // $doctors = Doctor::all();

        return Inertia::render('MedicalRecords/Edit', [
            'medicalRecord' => $medicalRecord,
            // 'patients' => $patients,
            // 'doctors' => $doctors,
        ]);
    }

    /**
     * Update the specified medical record in storage.
     */
    public function update(Request $request, string $id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);

        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'visit_date' => 'required|date',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $medicalRecord->update($validated);

        return redirect()->route('medical-records.show', $medicalRecord->id)->with('success', 'Medical record updated successfully.');
    }

    /**
     * Remove the specified medical record from storage.
     */
    public function destroy(string $id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);
        $medicalRecord->delete();

        return redirect()->route('medical-records.index')->with('success', 'Medical record deleted successfully.');
    }
}
