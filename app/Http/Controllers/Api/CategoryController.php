<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        // Get only categories with status == 1
        $categories = Category::where('status', 1)->get();

        // Return the data as JSON
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }
}
