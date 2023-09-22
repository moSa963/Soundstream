<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackLyrics extends Model
{
    use HasFactory;
    protected $table = "track_lyrics";

    protected $fillable = [
        'track_id',
        'lyrics',
        'timestamps',
    ];

    public function track() {
        return $this->belongsTo(Track::class);
    }
}
