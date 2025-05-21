<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PrescriptionController extends Controller
{
    /**
     * Display a paginated listing of prescriptions.
     */
    public function index()
    {
        $prescriptions = Prescription::with(['patient', 'doctor'])->paginate(15);

        return Inertia::render('Prescriptions/Index', [
            'prescriptions' => $prescriptions,
        ]);
    }

    /**
     * Show the form for creating a new prescription.
     */
    public function create()
    {
        // Optionally pass patients and doctors for selection
        // $patients = Patient::all();
        // $doctors = Doctor::all();

        return Inertia::render('Prescriptions/Create' /*, compact('patients', 'doctors') */);
    }

    /**
     * Store a newly created prescription in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'medication_name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'frequency' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        Prescription::create($validated);

        return redirect()->route('prescriptions.index')->with('success', 'Prescription created successfully.');
    }

    /**
     * Display the specified prescription.
     */
    public function show(string $id)
    {
        $prescription = Prescription::with(['patient', 'doctor'])->findOrFail($id);

        return Inertia::render('Prescriptions/Show', [
            'prescription' => $prescription,
        ]);
    }

    /**
     * Show the form for editing the specified prescription.
     */
    public function edit(string $id)
    {
        $prescription = Prescription::findOrFail($id);

        // Optionally pass patients and doctors for selection
        // $patients = Patient::all();
        // $doctors = Doctor::all();

        return Inertia::render('Prescriptions/Edit', [
            'prescription' => $prescription,
            // 'patients' => $patients,
            // 'doctors' => $doctors,
        ]);
    }

    /**
     * Update the specified prescription in storage.
     */
    public function update(Request $request, string $id)
    {
        $prescription = Prescription::findOrFail($id);

        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'medication_name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'frequency' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $prescription->update($validated);

        return redirect()->route('prescriptions.show', $prescription->id)->with('success', 'Prescription updated successfully.');
    }

    /**
     * Remove the specified prescription from storage.
     */
    public function destroy(string $id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->delete();

        return redirect()->route('prescriptions.index')->with('success', 'Prescription deleted successfully.');
    }
}
