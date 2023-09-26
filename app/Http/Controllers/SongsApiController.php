<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongsApiController extends Controller
{
    public function createSong(Request $request)
    {
        $song = [
            'title' => $request->title,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'file_path' => $request->file_path,
            'backup_file_path' => $request->backup_file_path,
            'space_id' => $request->space_id
        ];

        $data = Song::create($song);

        return response()->json($data);
    }

    public function getAllSongs()
    {
        $songs = Song::select('title', 'short_description', 'description', 'file_path', 'backup_file_path')->get();
        return response()->json($songs);
    }
}
