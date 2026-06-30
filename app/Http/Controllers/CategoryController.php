<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $landingCategories = Category::landing()->latest()->get();
        $productCategories = Category::product()->latest()->get();
        return view('cms.categories.index', compact('landingCategories', 'productCategories'));
    }

    public function create()
    {
        $type = request('type', 'landing');

        abort_unless(in_array($type, ['landing', 'product'], true), 404);

        return view('cms.categories.create', compact('type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'description' => 'nullable|string',
            'type' => ['required', Rule::in(['landing', 'product'])],
        ]);

        $imagePath = $request->file('image')->store('categories', 'public');

        Category::create([
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
            'type' => $request->type,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created!');
    }

    public function edit(Category $category)
    {
        $isLocked = $category->projects()->exists();

        return view('cms.categories.edit', compact('category', 'isLocked'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'description' => 'nullable|string',
            'type' => ['required', Rule::in(['landing', 'product'])],
        ]);

        $isLocked = $category->projects()->exists();

        if ($isLocked && $request->type !== $category->type) {
            return redirect()
                ->route('categories.edit', $category->id)
                ->withInput()
                ->with('error', 'Tipe category tidak bisa diubah karena category ini sudah dipakai pada project atau product.');
        }

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $category->image = $request->file('image')->store('categories', 'public');
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $category->image,
            'type' => $request->type,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated!');
    }

    public function destroy(Category $category)
    {
        if ($category->projects()->exists()) {
            return redirect()->route('categories.index')->with('error', 'Category tidak bisa dihapus karena masih digunakan pada project atau product.');
        }

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted!');
    }
}
