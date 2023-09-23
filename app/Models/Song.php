<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    public function albums()
    {
        return $this->belongsToMany(Album::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }
}
