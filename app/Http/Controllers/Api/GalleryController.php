<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FoundRequest;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index($id)
    {
        $data_image = FoundRequest::select('image')->where('user_id', $id)->get();
        $images = [];

        foreach ($data_image as $item) {
            $decodedImages = json_decode($item->image, true);
            if (is_array($decodedImages)) {
                $images = array_merge($images, $decodedImages);
            }
        }

        return response()->json(['images' => $images]);
    }
}
