<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Show a page with list of tickets
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('tickets.index');
    }

    /**
     * Show form to create a new ticket
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        return view('tickets.create');
    }
}
