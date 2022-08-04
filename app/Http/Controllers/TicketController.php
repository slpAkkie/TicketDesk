<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tickets\ShowRequest;
use App\Http\Requests\Tickets\StoreRequest;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Index all accepted tickets.
     *
     * @param Request $request
     * @return View
     */
    public function accepted(Request $request): View
    {
        return view('tickets.index', [
            'title' => 'All accepted tickets',
            'tickets' => Ticket::accepted()->paginate(15),
        ]);
    }

    /**
     * Index all tickets that has no responsible.
     *
     * @param Request $request
     * @return View
     */
    public function notAccepted(Request $request): View
    {
        return view('tickets.index', [
            'title' => 'Tickets waiting to accept',
            'tickets' => Ticket::notAccepted()->paginate(15),
        ]);
    }

    /**
     * Index all tickets that has been accepted by authorized user.
     *
     * @param Request $request
     * @return View
     */
    public function acceptedByAuthUser(Request $request): View
    {
        return view('tickets.index', [
            'title' => 'Tickets on me',
            'tickets' => Ticket::acceptedBy(Auth::user())->paginate(15),
        ]);
    }

    /**
     * Index all closed tickets.
     *
     * @param Request $request
     * @return View
     */
    public function closed(Request $request): View
    {
        return view('tickets.index', [
            'title' => 'All closed tickets',
            'tickets' => Ticket::closed()->paginate(15),
        ]);
    }

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
     * Accept ticket by authorized user.
     *
     * @param Ticket $ticket
     * @param Request $request
     * @return RedirectResponse
     */
    public function accept(Request $request, Ticket $ticket): RedirectResponse
    {
        $ticket->accept(Auth::user());

        return response()->redirectToRoute('tickets.show', $ticket);
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
