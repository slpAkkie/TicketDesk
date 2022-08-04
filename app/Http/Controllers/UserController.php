<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show user profile page.
     *
     * @param Request $request
     * @param User $user
     * @return View
     */
    public function profile(Request $request, User $user): View
    {
        return view('user.profile', [
            'user' => $user,
        ]);
    }
}
