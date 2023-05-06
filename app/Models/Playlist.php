<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    protected $table = "playlists";

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'photo',
        'album',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tracks(){
        return $this->belongsToMany(Track::class, PlaylistTrack::class)->withPivot(["created_at as added_at"]);
    }
}
