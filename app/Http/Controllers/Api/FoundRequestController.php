<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\FoundRequest;
use Illuminate\Http\Request;

class FoundRequestController extends Controller
{
    public function index()
    {
        // Fetch FoundRequest records with status == 1 one is active
        $fondRequests = FoundRequest::where('status', 1)->with('category')->get();
        return response()->json($fondRequests);
    }

    public function store(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'project_name' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'nid' => ['nullable', 'string', 'max:20'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'array'],
            'image.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'request_amount' => ['nullable', 'numeric'],
        ]);

        // Process and upload images if provided
        $images = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $images[] = $file->store('found_requests', 'public');
            }
        }

        // Create a new FoundRequest record
        $foundRequest = FoundRequest::create([
            'user_id' => $id,
            'project_name' => $request->project_name,
            'category' => $request->category,
            'nid' => $request->nid,
            'description' => $request->description,
            'location' => $request->location,
            'image' => $images ? json_encode($images) : null,
            'request_amount' => $request->request_amount,
            'status' => 0,
        ]);

        // Return a JSON response
        return response()->json([
            'message' => 'Found request created successfully.',
            'data' => $foundRequest,
        ], 201);
    }


    public function getmyfund($id)
    {
        try {
            // Fetch fund requests for the specified user ID, including the related 'foundCategory' and 'user'
            $fundRequests = FoundRequest::where('user_id', $id)
                ->with(['category', 'user'])
                ->get();

            // Return the response with the fetched data
            return response()->json([
                'success' => true,
                'data' => $fundRequests,
            ]);
        } catch (\Exception $e) {
            // Handle any exceptions and return an error response
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function show($id)
    {
        $foundRequest = FoundRequest::where('id', $id)
            ->where('status', 1)
            ->with(['category', 'user' => function ($query) {
                $query->select('id', 'name');
            }])
            ->first();
        return response()->json($foundRequest, 200);
    }
}
