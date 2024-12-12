<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DistributeFand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DistributeFandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributeFands = DistributeFand::all();
        // dd($distributeFands);
        return view('admin.distribute.index', compact('distributeFands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.distribute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'nid' => ['required', 'string', 'max:50'],
            'payment_type' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'nid_img' => ['required', 'array'],
            'nid_img.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'recept_img' => ['nullable', 'array'],
            'recept_img.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
        // image save
        $nidImages = [];
        if ($request->hasFile('nid_img')) {
            foreach ($request->file('nid_img') as $file) {
                $nidImages[] = $file->store('distribute_funds/nid_images', 'public');
            }
        }

        $receptImages = [];
        if ($request->hasFile('recept_img')) {
            foreach ($request->file('recept_img') as $file) {
                $receptImages[] = $file->store('distribute_funds/recept_images', 'public');
            }
        }

        $distributeFand = DistributeFand::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'nid' => $request->nid,
            'payment_type' => $request->payment_type,
            'amount' => $request->amount,
            'nid_img' => json_encode($nidImages),
            'recept_img' => json_encode($receptImages),
        ]);

        return redirect()->route('admin.distribute.index')->with('success', 'Distribute Fund created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\DistributeFand  $distributeFand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DistributeFand::findOrFail($id);
        // dd($data);
        return view('admin.distribute.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\DistributeFand  $distributeFand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DistributeFand::findOrFail($id);
        return view('admin.distribute.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\DistributeFand  $distributeFand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'nid' => ['required', 'string', 'max:50'],
            'payment_type' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'nid_img' => ['nullable', 'array'],
            'nid_img.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'recept_img' => ['nullable', 'array'],
            'recept_img.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $distributeFand = DistributeFand::findOrFail($id);

        // Initialize arrays for new images
        $nidImages = $distributeFand->nid_img ? json_decode($distributeFand->nid_img, true) : [];
        $receptImages = $distributeFand->recept_img ? json_decode($distributeFand->recept_img, true) : [];

        // Handle nid_img uploads
        if ($request->hasFile('nid_img')) {
            foreach ($nidImages as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            $nidImages = [];
            foreach ($request->file('nid_img') as $file) {
                $nidImages[] = $file->store('distribute_funds/nid_images', 'public');
            }
        }

        // Handle recept_img uploads
        if ($request->hasFile('recept_img')) {
            foreach ($receptImages as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            $receptImages = [];
            foreach ($request->file('recept_img') as $file) {
                $receptImages[] = $file->store('distribute_funds/recept_images', 'public');
            }
        }

        // Update the record
        $distributeFand->update([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'nid' => $request->nid,
            'payment_type' => $request->payment_type,
            'amount' => $request->amount,
            'nid_img' => json_encode($nidImages),
            'recept_img' => json_encode($receptImages),
        ]);
        return redirect()->route('admin.distribute.index')->with('success', 'Distribute Fund updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\DistributeFand  $distributeFand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distributeFand = DistributeFand::findOrFail($id);

        if ($distributeFand->nid_img) {
            $nidImages = json_decode($distributeFand->nid_img, true);
            foreach ($nidImages as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        if ($distributeFand->recept_img) {
            $receptImages = json_decode($distributeFand->recept_img, true);
            foreach ($receptImages as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $distributeFand->delete();
        return redirect()->back()->with('success', 'Record and associated images deleted successfully.');
    }
}
