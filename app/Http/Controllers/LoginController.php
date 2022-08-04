<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $authorized = Auth::attempt($request->only([
            'email',
            'password',
        ]), !!$request->get('remember'));

        if (!$authorized) {
            return back()->withErrors([
                'email' => 'No such user with provided email and password',
            ]);
        }

        return response()->redirectToRoute('dashboard');
    }

    /**
     * Logout user and redirect to home page for guest.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        return response()->redirectToRoute('tickets.create');
    }
}
