<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('cms.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('cms.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $path = $request->file('logo')->store('partners', 'public');

        Partner::create([
            'name' => $request->name,
            'logo' => $path,
        ]);

        return redirect()->route('partners.index')->with('success', 'Partner added.');
    }

    public function edit(Partner $partner)
    {
        return view('cms.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($partner->logo);
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('partners.index')->with('success', 'Partner updated.');
    }

    public function destroy(Partner $partner)
    {
        Storage::disk('public')->delete($partner->logo);
        $partner->delete();
        return redirect()->route('partners.index')->with('success', 'Partner deleted.');
    }
}
