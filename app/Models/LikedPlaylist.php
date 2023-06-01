<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikedPlaylist extends Model
{
    use HasFactory;
    protected $table = "liked_playlists";

    protected $fillable = [
        'user_id',
        'playlist_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}
