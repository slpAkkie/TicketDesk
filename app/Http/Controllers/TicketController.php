<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tickets\StoreRequest;
use App\Models\Ticket;
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
        return view('tickets.create');
    }

    /**
     * Create and store new ticket.
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        return response()->redirectToRoute('tickets.show');
    }

    /**
     * Show a page with ticket conversation.
     *
     * @param Request $request
     * @param Ticket $ticket
     * @return View
     */
    public function show(Request $request, Ticket $ticket): View
    {
        return view('show', [
            'ticket' => $ticket,
        ]);
    }
}
