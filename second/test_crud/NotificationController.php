<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationController extends Controller
{
    /**
     * Display a paginated listing of notifications.
     */
    public function index()
    {
        $notifications = Notification::with(['admin', 'recipient'])->paginate(15);

        return Inertia::render('Notifications/Index', [
            'notifications' => $notifications,
        ]);
    }

    /**
     * Show the form for creating a new notification.
     */
    public function create()
    {
        // Optionally pass data needed for creating notifications
        return Inertia::render('Notifications/Create');
    }

    /**
     * Store a newly created notification in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'recipient_id' => 'required|integer',
            'recipient_type' => 'required|string',
            'type' => 'required|string|max:255',
            'content' => 'required|string',
            'sent_date' => 'required|date',
        ]);

        Notification::create($validated);

        return redirect()->route('notifications.index')->with('success', 'Notification created successfully.');
    }

    /**
     * Display the specified notification.
     */
    public function show(string $id)
    {
        $notification = Notification::with(['admin', 'recipient'])->findOrFail($id);

        return Inertia::render('Notifications/Show', [
            'notification' => $notification,
        ]);
    }

    /**
     * Show the form for editing the specified notification.
     */
    public function edit(string $id)
    {
        $notification = Notification::findOrFail($id);

        return Inertia::render('Notifications/Edit', [
            'notification' => $notification,
        ]);
    }

    /**
     * Update the specified notification in storage.
     */
    public function update(Request $request, string $id)
    {
        $notification = Notification::findOrFail($id);

        $validated = $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'recipient_id' => 'required|integer',
            'recipient_type' => 'required|string',
            'type' => 'required|string|max:255',
            'content' => 'required|string',
            'sent_date' => 'required|date',
        ]);

        $notification->update($validated);

        return redirect()->route('notifications.show', $notification->id)->with('success', 'Notification updated successfully.');
    }

    /**
     * Remove the specified notification from storage.
     */
    public function destroy(string $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
    }
}
