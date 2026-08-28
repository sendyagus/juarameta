<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountSettingsController extends Controller
{
    public function index(Request $request): View
    {
        return view('account-settings', [
            'user' => $request->user(),
        ]);
    }
}
