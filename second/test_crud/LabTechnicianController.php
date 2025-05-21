<?php

namespace App\Http\Controllers;

use App\Models\LabTechnician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class LabTechnicianController extends Controller
{
    /**
     * Display a paginated listing of lab technicians.
     */
    public function index()
    {
        $labTechnicians = LabTechnician::paginate(15);

        return Inertia::render('LabTechnicians/Index', [
            'labTechnicians' => $labTechnicians,
        ]);
    }

    /**
     * Show the form for creating a new lab technician.
     */
    public function create()
    {
        return Inertia::render('LabTechnicians/Create');
    }

    /**
     * Store a newly created lab technician in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:lab_technicians,email',
            'specialty' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'license_number' => 'required|string|size:5|unique:lab_technicians,license_number',
            'password' => 'required|string|min:8|confirmed',
        ]);

        LabTechnician::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'specialty' => $validated['specialty'],
            'phone_number' => $validated['phone_number'],
            'license_number' => $validated['license_number'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('lab-technicians.index')->with('success', 'Lab Technician created successfully.');
    }

    /**
     * Display the specified lab technician.
     */
    public function show(string $id)
    {
        $labTechnician = LabTechnician::findOrFail($id);

        return Inertia::render('LabTechnicians/Show', [
            'labTechnician' => $labTechnician,
        ]);
    }

    /**
     * Show the form for editing the specified lab technician.
     */
    public function edit(string $id)
    {
        $labTechnician = LabTechnician::findOrFail($id);

        return Inertia::render('LabTechnicians/Edit', [
            'labTechnician' => $labTechnician,
        ]);
    }

    /**
     * Update the specified lab technician in storage.
     */
    public function update(Request $request, string $id)
    {
        $labTechnician = LabTechnician::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:lab_technicians,email,' . $labTechnician->id,
            'specialty' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'license_number' => 'required|string|size:5|unique:lab_technicians,license_number,' . $labTechnician->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $labTechnician->first_name = $validated['first_name'];
        $labTechnician->last_name = $validated['last_name'];
        $labTechnician->email = $validated['email'];
        $labTechnician->specialty = $validated['specialty'];
        $labTechnician->phone_number = $validated['phone_number'];
        $labTechnician->license_number = $validated['license_number'];

        if (!empty($validated['password'])) {
            $labTechnician->password = Hash::make($validated['password']);
        }

        $labTechnician->save();

        return redirect()->route('lab-technicians.show', $labTechnician->id)->with('success', 'Lab Technician updated successfully.');
    }

    /**
     * Remove the specified lab technician from storage.
     */
    public function destroy(string $id)
    {
        $labTechnician = LabTechnician::findOrFail($id);
        $labTechnician->delete();

        return redirect()->route('lab-technicians.index')->with('success', 'Lab Technician deleted successfully.');
    }
}
