<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Partner;
use App\Models\Project;
use Illuminate\Http\Request;

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
        $categories = Category::all();

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
        $categories = Category::orderBy('name')->get();
        $featuredProject = $projects->first();

        return view('product', compact('projects', 'categories', 'featuredProject'));
    }

     

}
