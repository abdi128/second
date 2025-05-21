<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MessageController extends Controller
{
    /**
     * Display a paginated listing of messages.
     */
    public function index()
    {
        // For example, load all messages with sender and recipient info
        $messages = Message::with(['sender', 'recipient'])->paginate(15);

        return Inertia::render('Messages/Index', [
            'messages' => $messages,
        ]);
    }

    /**
     * Show the form for creating a new message.
     */
    public function create()
    {
        // You might want to pass data about possible recipients, etc.
        return Inertia::render('Messages/Create');
    }

    /**
     * Store a newly created message in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_id' => 'required|integer',
            'sender_type' => 'required|string',
            'recipient_id' => 'required|integer',
            'recipient_type' => 'required|string',
            'content' => 'required|string',
            'status' => 'nullable|in:sent,delivered,read',
        ]);

        Message::create($validated);

        return redirect()->route('messages.index')->with('success', 'Message sent successfully.');
    }

    /**
     * Display the specified message.
     */
    public function show(string $id)
    {
        $message = Message::with(['sender', 'recipient'])->findOrFail($id);

        return Inertia::render('Messages/Show', [
            'message' => $message,
        ]);
    }

    /**
     * Show the form for editing the specified message.
     */
    public function edit(string $id)
    {
        $message = Message::findOrFail($id);

        return Inertia::render('Messages/Edit', [
            'message' => $message,
        ]);
    }

    /**
     * Update the specified message in storage.
     */
    public function update(Request $request, string $id)
    {
        $message = Message::findOrFail($id);

        $validated = $request->validate([
            'content' => 'required|string',
            'status' => 'required|in:sent,delivered,read',
        ]);

        $message->update($validated);

        return redirect()->route('messages.show', $message->id)->with('success', 'Message updated successfully.');
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy(string $id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('messages.index')->with('success', 'Message deleted successfully.');
    }
}
