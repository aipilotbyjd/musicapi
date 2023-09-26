<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'thumbnail_image',
        'user_id',
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }
}
