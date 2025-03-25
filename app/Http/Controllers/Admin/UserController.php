<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\Division;
use App\Thana;

class UserController extends Controller
{




    public function index()
    {
        $users = User::where('role_id', 2)->orWhere('role_id', 4)->with('category')->get();
        return view('admin.user.index', compact('users'));
    }




    public function DonerIndex()
    {
        $users = User::where('role_id', 3)->with('category')->get();
        return view('admin.user.doner-index', compact('users'));
    }




    public function block()
    {
        $users = User::where('role_id', 4)->get();
        return view('admin.user.block', compact('users'));
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);
        $thanas = Thana::all();
        $division = Division::all();
        // dd($user);

        return view('admin.user.edit', compact('user', 'thanas', 'division'));
    }




    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // dd($request->all());

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable',

        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'division_id' => $request->division,
            'district_id' => $request->district,
            'thana_id' => $request->thana,
            'role_id' => $request->role_id == 'on' ? 4 : 2,
        ];

        if ($request->email_verified_at) {
            $data['email_verified_at'] = now();
        }

        // dd($data);


        $image = $request->file('image');
        if ($image) {
            if ($user->image) {
                $filePath = public_path('storage/user/' . $user->image);
                if ($filePath) {
                    unlink($filePath);
                }
            }

            $reviewDirectory = public_path('storage/user');
            File::makeDirectory($reviewDirectory, 0755, true, true);

            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $uniqueName = $originalName . '_' . Str::random(20) . '_' . uniqid() . '.' . '.webp';
            Image::make($image)->save('storage/user/' . $uniqueName, 90, 'webp');

            $data['image'] = $uniqueName;
        }
        $user->update($data);


        // Redirect back with success message
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }



    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User Delete Success');
    }
}
