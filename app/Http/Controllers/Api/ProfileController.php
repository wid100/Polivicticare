<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $user =  User::find($id);
        if ($request->roll == 'victim') {
            $request->validate([
                'roll' => 'required',
                'name' => 'required|max:255',
                'nid' => 'required',
                'description' => 'nullable',
                'reference' => 'required',
                'party_designation' => 'required',
                'location' => 'required',
                'category' => 'nullable',
                'organization' => 'nullable',
                'bkash_number' => 'required',
            ]);
        } elseif ($request->roll == 'donor') {
            $request->validate([
                'roll' => 'required',
                'status' => 'required',
                'name' => 'nullable|max:255',
                'nid' => 'nullable',
                'party_designation' => 'nullable',
                'location' => 'nullable',
                'category' => 'nullable',
                'organization' => 'nullable',
            ]);
        }

        if ($request->roll == 'victim') {
            $data = [
                'name' => $request->name,
                'role_id' => 2,
                'nid' => $request->nid,
                'problem_description' => $request->description,
                'reference' => $request->reference,
                'party_designation' => $request->party_designation,
                'location' => $request->location,
                'category' => $request->category,
                'organization' => $request->organization,
                'bank_info' => $request->bkash_number,
            ];
        } elseif ($request->roll == 'donor') {
            $data = [
                'name' => $request->name,
                'role_id' => 1,
                'nid' => $request->nid,
                'party_designation' => $request->party_designation,
                'location' => $request->location,
                'category' => $request->category,
                'organization' => $request->organization,
                'status' => $request->status, // 1 = with name
            ];
        }


        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = time() . '-' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path('image/user');

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);
            $data['image'] = json_encode('image/user' . '/' . $fileName);
        }
        $user->update($data);


        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $data,
        ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
