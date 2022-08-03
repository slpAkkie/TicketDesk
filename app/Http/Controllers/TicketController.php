<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
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
}
