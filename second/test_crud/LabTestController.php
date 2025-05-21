<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LabTestController extends Controller
{
    /**
     * Display a paginated listing of lab tests.
     */
    public function index()
    {
        $labTests = LabTest::with(['patient', 'doctor', 'technician'])->paginate(15);

        return Inertia::render('LabTests/Index', [
            'labTests' => $labTests,
        ]);
    }

    /**
     * Show the form for creating a new lab test.
     */
    public function create()
    {
        // Optionally pass patients, doctors, technicians for selection
        // $patients = Patient::all();
        // $doctors = Doctor::all();
        // $technicians = LabTechnician::all();

        return Inertia::render('LabTests/Create' /*, compact('patients', 'doctors', 'technicians') */);
    }

    /**
     * Store a newly created lab test in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'technician_id' => 'required|exists:lab_technicians,id',
            'test_type' => 'required|string|max:255',
            'test_result' => 'required|string',
            'request_date' => 'required|date',
            'status' => 'required|in:Pending,Cancelled,Complete',
            'notes' => 'nullable|string',
        ]);

        LabTest::create($validated);

        return redirect()->route('lab-tests.index')->with('success', 'Lab test created successfully.');
    }

    /**
     * Display the specified lab test.
     */
    public function show(string $id)
    {
        $labTest = LabTest::with(['patient', 'doctor', 'technician'])->findOrFail($id);

        return Inertia::render('LabTests/Show', [
            'labTest' => $labTest,
        ]);
    }

    /**
     * Show the form for editing the specified lab test.
     */
    public function edit(string $id)
    {
        $labTest = LabTest::findOrFail($id);

        // Optionally pass patients, doctors, technicians for selection
        // $patients = Patient::all();
        // $doctors = Doctor::all();
        // $technicians = LabTechnician::all();

        return Inertia::render('LabTests/Edit', [
            'labTest' => $labTest,
            // 'patients' => $patients,
            // 'doctors' => $doctors,
            // 'technicians' => $technicians,
        ]);
    }

    /**
     * Update the specified lab test in storage.
     */
    public function update(Request $request, string $id)
    {
        $labTest = LabTest::findOrFail($id);

        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'technician_id' => 'required|exists:lab_technicians,id',
            'test_type' => 'required|string|max:255',
            'test_result' => 'required|string',
            'request_date' => 'required|date',
            'status' => 'required|in:Pending,Cancelled,Complete',
            'notes' => 'nullable|string',
        ]);

        $labTest->update($validated);

        return redirect()->route('lab-tests.show', $labTest->id)->with('success', 'Lab test updated successfully.');
    }

    /**
     * Remove the specified lab test from storage.
     */
    public function destroy(string $id)
    {
        $labTest = LabTest::findOrFail($id);
        $labTest->delete();

        return redirect()->route('lab-tests.index')->with('success', 'Lab test deleted successfully.');
    }
}
