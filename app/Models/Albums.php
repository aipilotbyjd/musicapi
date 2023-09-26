<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'thumbnail_image',
        'space_id',
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }
}
