<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FoundRequest;

class FoundRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $foundrequests = FoundRequest::all();
    //     return view('admin.foundrequest.index', compact('foundrequests'));
    // }


    public function index()
    {
        $foundrequests = FoundRequest::with(['foundCategory', 'user'])->get();

        return view('admin.foundrequest.index', compact('foundrequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fundrequest = FoundRequest::findOrFail($id);
        return view('admin.foundrequest.edit', compact('fundrequest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'status' => 'required',
        ]);

        // Convert "on" to 1 and handle unchecked state

        $data['status'] = $request->status;

        $foundrequest = FoundRequest::findOrFail($id);
        $foundrequest->update($data);

        return redirect()->route('admin.foundrequest.index')->with('success', 'Fund Request updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foundRequest = FoundRequest::find($id);

        if ($foundRequest) {
            $images = json_decode($foundRequest->image, true);

            if (!empty($images)) {
                foreach ($images as $image) {
                    $imagePath = storage_path('app/public/' . $image);

                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }

            $foundRequest->delete();

            return redirect()->route('admin.foundrequest.index')->with('success', 'Found request deleted successfully!');
        } else {
            return redirect()->route('admin.foundrequest.index')->with('error', 'Found request not found!');
        }
    }
}
