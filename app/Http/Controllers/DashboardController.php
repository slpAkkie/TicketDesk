<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show dashboard.
     *
     * @param Request $request
     * @return View
     */
    public function dashboard(Request $request): View
    {
        return view('dashboard');
    }
}
