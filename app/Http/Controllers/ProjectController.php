<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('is_product', false)->latest()->get();
        return view('cms.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('cms.projects.create',compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'category_id' => 'required|exists:categories,id',  // update validasi kategori
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:10248',
        'model_path' => 'nullable|file|mimes:glb|max:100248',
    ]);
    
    $imagePath = $request->file('image')?->store('projects', 'public');
    $modelPath = $request->file('model_path')?->store('models', 'public');
    
    Project::create([
        'title' => $request->title,
        'description' => $request->description,
        'category_id' => $request->category_id, // simpan category_id bukan category
        'is_product' => false,
        'image' => $imagePath,
        'model_path' => $modelPath,
        'spatial_link' => $request->spatial_link,
    ]);
    

    return redirect()->route('projects.index')->with('success', 'Project created successfully.');
}

    public function edit(Project $project)
    {
        $categories = Category::all();
        return view('cms.projects.edit', compact('project','categories'));
    }

    public function update(Request $request, Project $project)
{
    $request->validate([
        'title' => 'required',
        'category_id' => 'required|exists:categories,id',  // update validasi kategori
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10248',
        'model_path' => 'nullable|file|mimes:glb|max:100248',
    ]);
    
    if ($request->hasFile('image')) {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $imagePath = $request->file('image')->store('projects', 'public');
        $project->image = $imagePath;
    }
    
    if ($request->hasFile('model_path')) {
        if ($project->model_path) {
            Storage::disk('public')->delete($project->model_path);
        }
        $modelPath = $request->file('model_path')->store('models', 'public');
        $project->model_path = $modelPath;
    }
    
    $project->title = $request->title;
    $project->description = $request->description;
    $project->category_id = $request->category_id;  // update sini juga
    $project->is_product = false;
    $project->spatial_link = $request->spatial_link;
    
    $project->save();
    

    return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
}

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
