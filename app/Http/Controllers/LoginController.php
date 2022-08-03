<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Show form for login.
     *
     * @param Request $request
     * @return View
     */
    public function page(Request $request): View
    {
        return view('auth.login');
    }

    /**
     * Try to login with provided credentials.
     * ! Now it's just a redirect back to login page.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        return response()->redirectToRoute('login');
    }
}
