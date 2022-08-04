<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.register');
    }

    /**
     * Try to register new user.
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = new User($request->only([
            'name',
            'email',
        ]));

        // If checkbox about to give admin access
        // rights is on.
        if ($request->get('admin')) {
            /** @var User */
            $_ = Auth::user();
            // And authorized user is super.
            $user->admin = $_->isSuper();
        }

        $user
            ->setPassword($request->get('password'))
            ->save();

        return response()->redirectToRoute('dashboard');
    }
}
