<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Aws\S3\S3Client;

class SongsApiController extends Controller
{
    public function createSong(Request $request)
    {

        $client = new S3Client([
            'version' => 'latest',
            'region'  => 'ap-southeast-1',
            'endpoint' => 'https://s3.ap-southeast-1.wasabisys.com',
            'use_path_style_endpoint' => false, // Configures to use subdomain/virtual calling format.
            'credentials' => [
                'key'    => 'OWEAKRTPW1ZABUFOWGFQ',
                'secret' => 'elC4UDU84j8LBiK3fDBHzNOZwABzak8D2yfQLjnO',
            ],
        ]);


        $spaces = $client->listBuckets();

        dd($spaces);

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
        $client = new S3Client([
            'version' => 'latest',
            'region'  => 'ap-southeast-1',
            'endpoint' => 'https://s3.ap-southeast-1.wasabisys.com',
            'use_path_style_endpoint' => false, // Configures to use subdomain/virtual calling format.
            'credentials' => [
                'key'    => 'OWEAKRTPW1ZABUFOWGFQ',
                'secret' => 'elC4UDU84j8LBiK3fDBHzNOZwABzak8D2yfQLjnO',
            ],
        ]);

        // $client->createBucket([
        //     'Bucket' => 'Mahalanob',
        // ]);

        // $spaces = $client->listBuckets();

        $client->putObject([
            'Bucket' => 'Mahalanob',
            'Key'    => 'file.ext',
            'Body'   => 'The contents of the file.',
            'ACL'    => 'private',
            'Metadata'   => array(
                'aby' => 'your-value'
            )
        ]);



        $objects = $client->listObjects([
            'Bucket' => 'Mahalanob',
        ]);

        dd($objects);
        // $songs = Song::select('title', 'short_description', 'description', 'file_path', 'backup_file_path')->get();
        // return response()->json($songs);
    }
}
