<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Index users.
     *
     * @param Request $request
     * @return View
     */
    public function users(Request $request): View
    {
        /** @var User */
        $admin = Auth::user();

        return view('admin.users', [
            'users' => ($admin->isSuper() ? User::allExceptAuth() : User::notAdmins())->paginate(15),
        ]);
    }
}
