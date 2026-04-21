<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::with('user')->latest()->paginate(10);
        return view('admin.support_tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('admin.support_tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        SupportTicket::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
        ]);

        return redirect()->route('admin.support-tickets.index')->with('success', 'Ticket creado correctamente.');
    }

    public function show(SupportTicket $supportTicket)
    {
        return view('admin.support_tickets.show', compact('supportTicket'));
    }

    public function update(Request $request, SupportTicket $supportTicket)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $supportTicket->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.support-tickets.index')->with('success', 'Estado del ticket actualizado.');
    }

    public function destroy(SupportTicket $supportTicket)
    {
        $supportTicket->delete();
        return redirect()->route('admin.support-tickets.index')->with('success', 'Ticket eliminado.');
    }
}
