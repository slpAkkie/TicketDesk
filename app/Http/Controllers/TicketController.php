<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tickets\ShowRequest;
use App\Http\Requests\Tickets\StoreRequest;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Show form to create a new ticket.
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        return view('tickets.create', [
            'categories' => TicketCategory::all(),
        ]);
    }

    /**
     * Create and store new ticket.
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $ticket = new Ticket($request->only([
            'name',
            'email',
            'title',
            'category_id',
            'description',
        ]));

        $ticket->save();

        return response()->redirectToRoute('tickets.show', $ticket);
    }

    /**
     * Show a page with ticket conversation.
     *
     * @param ShowRequest $request
     * @param Ticket $ticket
     * @return View
     */
    public function show(ShowRequest $request, Ticket $ticket): View
    {
        return view('tickets.show', [
            'ticket' => $ticket,
            'messages' => $ticket->messages()->orderBy('created_at', 'DESC')->paginate(15),
        ]);
    }

    /**
     * Close a ticket.
     *
     * @param Request $request
     * @param Ticket $ticket
     * @return RedirectResponse
     */
    public function close(Request $request, Ticket $ticket): RedirectResponse
    {
        $ticket->close();

        return response()->redirectToRoute('tickets.show', $ticket);
    }
}
