<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistTrack extends Model
{
    use HasFactory;
    protected $table = "playlists_tracks";

    protected $fillable = [
        'track_id',
        'playlist_id',
    ];
}
