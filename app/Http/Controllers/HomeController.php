<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $categories = Category::landing()->get();

        $slidesData = $categories->map(function ($category) {
            return [
                'title' => $category->name,
                'img' => $category->image ? asset('storage/' . $category->image) : null,
                'desc' => $category->description,
            ];
        });

        $projects = Project::where('is_product', false)->get();
        $partners = Partner::all();

        return view('home', compact('projects', 'partners', 'categories', 'slidesData'));
    }

    public function product()
    {
        $projects = Project::with('category')->where('is_product', true)->latest()->get();
        $categories = Category::product()->orderBy('name')->get();
        $featuredProject = $projects->first();
        $purchasedProjectIds = Auth::check()
            ? Purchase::where('user_id', Auth::id())->where('status', 'paid')->pluck('project_id')->all()
            : [];

        return view('product', [
            'projects' => $projects,
            'categories' => $categories,
            'featuredProject' => $featuredProject,
            'purchasedProjectIds' => $purchasedProjectIds,
            'isLoggedIn' => Auth::check(),
            'loginUrl' => route('login', ['redirect' => route('product')]),
        ]);
    }
}
