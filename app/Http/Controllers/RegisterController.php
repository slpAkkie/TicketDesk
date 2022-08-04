<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Show page to register new user.
     *
     * @param Request $request
     * @return View
     */
    public function page(Request $request): View
    {
        return view('auth.create');
    }

    /**
     * Try to register new user.
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        return response()->redirectToRoute('dashboard');
    }
}
