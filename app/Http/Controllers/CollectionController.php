<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CollectionController extends Controller
{
    public function index(Request $request): View
    {
        $purchases = Purchase::query()
            ->with('project.category')
            ->where('user_id', $request->user()->id)
            ->where('status', 'paid')
            ->latest('paid_at')
            ->get();

        return view('my-collection', [
            'user' => $request->user(),
            'purchases' => $purchases,
        ]);
    }
}
