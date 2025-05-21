<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    /**
     * Display a paginated listing of appointments.
     */
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor'])->paginate(15);

        return Inertia::render('Appointments/Index', [
            'appointments' => $appointments,
        ]);
    }

    /**
     * Show the form for creating a new appointment.
     */
    public function create()
    {
        // You might want to pass patients and doctors lists for selection
        // For example:
        // $patients = Patient::all();
        // $doctors = Doctor::all();
        // return Inertia::render('Appointments/Create', compact('patients', 'doctors'));

        return Inertia::render('Appointments/Create');
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|integer|min:1',
            'status' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Appointment::create($validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified appointment.
     */
    public function show(string $id)
    {
        $appointment = Appointment::with(['patient', 'doctor'])->findOrFail($id);

        return Inertia::render('Appointments/Show', [
            'appointment' => $appointment,
        ]);
    }

    /**
     * Show the form for editing the specified appointment.
     */
    public function edit(string $id)
    {
        $appointment = Appointment::findOrFail($id);

        // Optionally pass patients and doctors for selection
        // $patients = Patient::all();
        // $doctors = Doctor::all();

        return Inertia::render('Appointments/Edit', [
            'appointment' => $appointment,
            // 'patients' => $patients,
            // 'doctors' => $doctors,
        ]);
    }

    /**
     * Update the specified appointment in storage.
     */
    public function update(Request $request, string $id)
    {
        $appointment = Appointment::findOrFail($id);

        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|integer|min:1',
            'status' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($validated);

        return redirect()->route('appointments.show', $appointment->id)->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified appointment from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
