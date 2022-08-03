<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tickets\StoreMessageRequest;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TicketMessageController extends Controller
{
    /**
     * Store new message to the ticket.
     *
     * @param StoreMessageRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMessageRequest $request, Ticket $ticket): RedirectResponse
    {
        $ticket->messages()->create([
            'content' => $request->get('content'),
            'user_id' => Auth::user(),
        ]);

        return response()->redirectToRoute('tickets.show', $ticket);
    }
}
