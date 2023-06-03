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
        return $this->playlists()->where("album", true);
    }

    public function likes(){
        return $this->hasMany(LikedTrack::class);
    }
}
