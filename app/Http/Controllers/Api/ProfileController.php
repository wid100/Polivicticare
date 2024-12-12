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
        $request->validate([
            'roll' => 'required|in:victim,donor',
        ]);
        if ($request->roll == 'victim') {
            $rules = [
                'name' => 'required|max:255',
                'nid' => 'nullable',
                'description' => 'nullable',
                'party_designation' => 'required',
                'category' => 'nullable',
                'organization' => 'nullable',
                'division_id' => 'required',
                'district_id' => 'required',
                'thana_id' => 'required',
                'union_id' => 'nullable',
                'pourashava_id' => 'nullable',
                'ward_id' => 'nullable',
                'house' => 'required',
                'reference_name' => 'required',
                'location' => 'required',
                'reference_email' => 'required',
                'reference_phone' => 'required',
                'reference_organization_id' => 'nullable',
                'reference_district' => 'nullable',
                'reference_location' => 'nullable',
            ];
            if (!empty($request->mobile_wallet_name)) {
                $rules['mobile_wallet_name'] = 'required|string|max:255';
                $rules['mobile_wallet_number'] = 'required|string|max:255';
            } else {
                $rules['bank_name'] = 'required|string|max:255';
                $rules['bank_holder_name'] = 'required|string|max:255';
                $rules['bank_branch_name'] = 'required|string|max:255';
                $rules['bank_account_number'] = 'required|string|max:255';
            }

            // $request->validate([
            //     'name' => 'required|max:255',
            //     'nid' => 'nullable',
            //     'description' => 'nullable',
            //     'party_designation' => 'required',
            //     'category' => 'nullable',
            //     'organization' => 'nullable',
            //     'bkash_number' => 'required',
            //     'division_id' => 'required',
            //     'district_id' => 'required',
            //     'thana_id' => 'required',
            //     'union_id' => 'nullable',
            //     'pourashava_id' => 'nullable',
            //     'ward_id' => 'nullable',
            //     'house' => 'required',
            //     'reference_name' => 'required',
            //     'location' => 'required',
            //     'reference_email' => 'required',
            //     'reference_phone' => 'required',
            //     'reference_organization_id' => 'nullable',
            //     'reference_district' => 'nullable',
            //     'reference_location' => 'nullable',

            // ]);
            $request->validate($rules);
        } elseif ($request->roll == 'donor') {
            $request->validate([
                'name' => 'nullable|max:255',
                // 'nid' => 'nullable',
                'party_designation' => 'nullable',
                'location' => 'nullable',
                'category' => 'nullable',
                'organization' => 'nullable',
            ]);
        }

        $data = [
            'name' => $request->name,
            // 'nid' => $request->nid,
            'party_designation' => $request->party_designation,
            'location' => $request->location,
            'category_id' => $request->category,
            'organization_id' => $request->organization,
        ];

        // Role-specific fields
        if ($request->roll === 'victim') {
            $data = array_merge($data, [
                'role_id' => 2,
                'problem_description' => $request->description,
                'reference_name' => $request->reference,
                'party_designation' => $request->party_designation,
                'location' => $request->location,
                'bank_info' => $request->bkash_number,
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'thana_id' => $request->thana_id,
                'union_id' => $request->union_id,
                'pourashava_id' => $request->pourashava_id,
                'ward_id' => $request->ward_id,
                'house' => $request->house,
                'reference_name' => $request->reference_name,
                'reference_phone' => $request->reference_phone,
                'reference_email' => $request->reference_email,
                'reference_organization_id' => $request->reference_organization_id,
                'reference_district' => $request->reference_district,
                'reference_location' => $request->reference_location,
                'other_category' => $request->other_category,
                'other_organization' => $request->other_organization,
                //mobile banking information
                'mobile_wallet_name' => $request->mobile_wallet_name,
                'mobile_wallet_number' => $request->mobile_wallet_number,
                // bank information
                'bank_name' => $request->bank_name,
                'bank_holder_name' => $request->bank_holder_name,
                'bank_branch_name' => $request->bank_branch_name,
                'bank_account_number' => $request->bank_account_number,
            ]);
        } elseif ($request->roll === 'donor') {
            $data = array_merge($data, [
                'role_id' => 3,
                'nid' => $request->nid,
                'party_designation' => $request->party_designation,
                'location' => $request->location,
            ]);
        }


        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = time() . '-' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path('image/user');

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);
            $data['image'] = 'image/user/' . $fileName;
        }

        $user->update($data);



        return response()->json([
            'success' => true,
            'message' => 'Profile Update successfully',
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
