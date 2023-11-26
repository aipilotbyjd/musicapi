<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SongsApiController extends Controller
{
    public function createSong(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'short_description' => 'required',
            'song_file' => 'required|audio',
            'space_id' => 'required',
        ], [
            'song_file.required' => 'Please Upload Your Song',
            'song_file.audio' => 'Please Upload Proper Song',
        ]);


        if ($validator->fails()) {
            return response($validator->errors());
        }

        if($request->hasFile('song_file')){
            dd($request->getFile('song_file'));
        }

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
