<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tracks(){
        return $this->hasMany(Track::class);
    }

    public function tracks_history(){
        return $this->hasMany(TrackHistory::class)->latest("updated_at");
    }

    public function liked_tracks(){
        return $this->belongsToMany(Track::class, LikedTrack::class);
    }

    public function playlists(){
        return $this->hasMany(Playlist::class)->where("album", false);
    }

    public function albums(){
        return $this->hasMany(Playlist::class)->where("album", true);
    }
}
