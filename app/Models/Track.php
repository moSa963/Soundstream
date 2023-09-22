<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $table = "tracks";

    protected $fillable = [
        'user_id',
        'title',
        'location',
        'duration',
        'explicit',
        'photo',
        'written_by',
        'performed_by',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function playlists(){
        return $this->belongsToMany(Playlist::class, PlaylistTrack::class);
    }

    public function album(){
        return $this->playlists()->where("album", true)->take(1);
    }

    public function likes(){
        return $this->hasMany(LikedTrack::class);
    }

    public function lyrics(){
        return $this->hasOne(TrackLyrics::class);
    }

    public static function public_tracks(){
        return Track::select("tracks.*")
                    ->join("playlists_tracks", "playlists_tracks.track_id", "=", "tracks.id")
                    ->join("playlists", "playlists.id", "=", "playlists_tracks.playlist_id")
                    ->where("playlists.album", true)
                    ->where("playlists.private", false);
    }
}
