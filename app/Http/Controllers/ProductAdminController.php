<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductAdminController extends Controller
{
    public function index()
    {
        $products = Project::with('category')->where('is_product', true)->latest()->get();
        return view('cms.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('cms.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'category_id'  => 'required|exists:categories,id',
            'price'        => 'required|integer|min:0',
            'author'       => 'nullable|string|max:255',
            'is_hot'       => 'nullable|boolean',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'model_path'   => [
                'nullable',
                'file',
                'max:40960', // 40 MB (sesuai upload_max_filesize di PHP)
                function ($attribute, $value, $fail) {
                    $ext = strtolower($value->getClientOriginalExtension());
                    if (!in_array($ext, ['glb', 'fbx'])) {
                        $fail('File model 3D harus berformat .glb atau .fbx.');
                    }
                },
            ],
            'spatial_link' => 'nullable|url',
        ]);

        $imagePath = $request->file('image')?->store('projects', 'public');

        if ($request->hasFile('model_path')) {
            $modelFile = $request->file('model_path');
            $ext       = strtolower($modelFile->getClientOriginalExtension());
            $modelPath = $modelFile->storeAs('models', uniqid('model_', true) . '.' . $ext, 'public');
        } else {
            $modelPath = null;
        }

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'author' => $request->author,
            'is_hot' => $request->boolean('is_hot'),
            'is_product' => true,
            'image' => $imagePath,
            'model_path' => $modelPath,
            'spatial_link' => $request->spatial_link,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Project $product)
    {
        if (!$product->is_product) {
            abort(404);
        }
        $categories = Category::orderBy('name')->get();
        return view('cms.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Project $product)
    {
        if (!$product->is_product) {
            abort(404);
        }
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'category_id'  => 'required|exists:categories,id',
            'price'        => 'required|integer|min:0',
            'author'       => 'nullable|string|max:255',
            'is_hot'       => 'nullable|boolean',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'model_path'   => [
                'nullable',
                'file',
                'max:40960', // 40 MB (sesuai upload_max_filesize di PHP)
                function ($attribute, $value, $fail) {
                    $ext = strtolower($value->getClientOriginalExtension());
                    if (!in_array($ext, ['glb', 'fbx'])) {
                        $fail('File model 3D harus berformat .glb atau .fbx.');
                    }
                },
            ],
            'spatial_link' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('projects', 'public');
        }

        if ($request->hasFile('model_path')) {
            if ($product->model_path) {
                Storage::disk('public')->delete($product->model_path);
            }
            $modelFile          = $request->file('model_path');
            $ext                = strtolower($modelFile->getClientOriginalExtension());
            $product->model_path = $modelFile->storeAs('models', uniqid('model_', true) . '.' . $ext, 'public');
        }

        $product->title = $request->title;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->author = $request->author;
        $product->is_hot = $request->boolean('is_hot');
        $product->is_product = true;
        $product->spatial_link = $request->spatial_link;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Project $product)
    {
        if (!$product->is_product) {
            abort(404);
        }
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        if ($product->model_path) {
            Storage::disk('public')->delete($product->model_path);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
