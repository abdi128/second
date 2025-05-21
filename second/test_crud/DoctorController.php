<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class DoctorController extends Controller
{
    /**
     * Display a paginated listing of doctors.
     */
    public function index()
    {
        $doctors = Doctor::paginate(15);

        return Inertia::render('Doctors/Index', [
            'doctors' => $doctors,
        ]);
    }

    /**
     * Show the form for creating a new doctor.
     */
    public function create()
    {
        return Inertia::render('Doctors/Create');
    }

    /**
     * Store a newly created doctor in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'phone_number' => 'required|string|max:20',
            'specialty' => 'required|string|max:255',
            'license_number' => 'required|string|size:5|unique:doctors,license_number',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Doctor::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'specialty' => $validated['specialty'],
            'license_number' => $validated['license_number'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    /**
     * Display the specified doctor.
     */
    public function show(string $id)
    {
        $doctor = Doctor::findOrFail($id);

        return Inertia::render('Doctors/Show', [
            'doctor' => $doctor,
        ]);
    }

    /**
     * Show the form for editing the specified doctor.
     */
    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail($id);

        return Inertia::render('Doctors/Edit', [
            'doctor' => $doctor,
        ]);
    }

    /**
     * Update the specified doctor in storage.
     */
    public function update(Request $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'phone_number' => 'required|string|max:20',
            'specialty' => 'required|string|max:255',
            'license_number' => 'required|string|size:5|unique:doctors,license_number,' . $doctor->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $doctor->first_name = $validated['first_name'];
        $doctor->last_name = $validated['last_name'];
        $doctor->email = $validated['email'];
        $doctor->phone_number = $validated['phone_number'];
        $doctor->specialty = $validated['specialty'];
        $doctor->license_number = $validated['license_number'];

        if (!empty($validated['password'])) {
            $doctor->password = Hash::make($validated['password']);
        }

        $doctor->save();

        return redirect()->route('doctors.show', $doctor->id)->with('success', 'Doctor updated successfully.');
    }

    /**
     * Remove the specified doctor from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
