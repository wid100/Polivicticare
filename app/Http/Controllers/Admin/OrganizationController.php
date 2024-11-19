<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('admin.organizations.index', compact('organizations'));
    }

    public function create()
    {
        return view('admin.organizations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|string',
        ]);

        Organization::create([
            'name' => $request->name,
            'status' => $request->status === 'on' ? 1 : 0,
        ]);

        return redirect()->route('admin.organization.index')->with('success', 'Organization created successfully!');
    }

    public function edit($id)
    {
        $organization = Organization::findOrFail($id);
        return view('admin.organizations.edit', compact('organization'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|string',
        ]);

        $organization = Organization::findOrFail($id);
        $organization->update([
            'name' => $request->name,
            'status' => $request->status === 'on' ? 1 : 0,
        ]);

        return redirect()->route('admin.organization.index')->with('success', 'Organization updated successfully!');
    }

    public function destroy($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->delete();

        return redirect()->route('admin.organization.index')->with('success', 'Organization deleted successfully!');
    }
}
