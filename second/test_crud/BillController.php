<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BillController extends Controller
{
    /**
     * Display a paginated listing of bills.
     */
    public function index()
    {
        $bills = Bill::with(['patient', 'admin'])->paginate(15);

        return Inertia::render('Bills/Index', [
            'bills' => $bills,
        ]);
    }

    /**
     * Show the form for creating a new bill.
     */
    public function create()
    {
        // Optionally pass patients and admins for selection
        // $patients = Patient::all();
        // $admins = Admin::all();

        return Inertia::render('Bills/Create' /*, compact('patients', 'admins') */);
    }

    /**
     * Store a newly created bill in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'admin_id' => 'required|exists:admins,id',
            'service_description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'issued_date' => 'required|date',
            'payment' => 'required|in:Unpaid,Pending,Paid',
            'status' => 'required|in:Pending,Complete,Invalid',
        ]);

        Bill::create($validated);

        return redirect()->route('bills.index')->with('success', 'Bill created successfully.');
    }

    /**
     * Display the specified bill.
     */
    public function show(string $id)
    {
        $bill = Bill::with(['patient', 'admin'])->findOrFail($id);

        return Inertia::render('Bills/Show', [
            'bill' => $bill,
        ]);
    }

    /**
     * Show the form for editing the specified bill.
     */
    public function edit(string $id)
    {
        $bill = Bill::findOrFail($id);

        // Optionally pass patients and admins for selection
        // $patients = Patient::all();
        // $admins = Admin::all();

        return Inertia::render('Bills/Edit', [
            'bill' => $bill,
            // 'patients' => $patients,
            // 'admins' => $admins,
        ]);
    }

    /**
     * Update the specified bill in storage.
     */
    public function update(Request $request, string $id)
    {
        $bill = Bill::findOrFail($id);

        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'admin_id' => 'required|exists:admins,id',
            'service_description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'issued_date' => 'required|date',
            'payment' => 'required|in:Unpaid,Pending,Paid',
            'status' => 'required|in:Pending,Complete,Invalid',
        ]);

        $bill->update($validated);

        return redirect()->route('bills.show', $bill->id)->with('success', 'Bill updated successfully.');
    }

    /**
     * Remove the specified bill from storage.
     */
    public function destroy(string $id)
    {
        $bill = Bill::findOrFail($id);
        $bill->delete();

        return redirect()->route('bills.index')->with('success', 'Bill deleted successfully.');
    }
}
