<?php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;

class SpacesApiController extends Controller
{
    public function createSpace(Request $request)
    {
        $space = [
            'title' => $request->title,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'file_path' => $request->file_path,
            'backup_file_path' => $request->backup_file_path,
            'space_id' => $request->space_id
        ];

        $data = Space::create($space);

        return response()->json($data);
    }

    public function getAllSpaces()
    {
        $spaces = Space::select('name', 'description', 'thumbnail_image', 'thumbnail_background_image', 'is_public', 'user_id')->get();
        return response()->json($spaces);
    }
}
