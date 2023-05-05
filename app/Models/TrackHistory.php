<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackHistory extends Model
{
    use HasFactory;
    protected $table = "track_history";

    protected $fillable = [
        'user_id',
        'track_id',
        'play_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public static function add(User $user, Track $track)
    {
        $trackHistory = TrackHistory::firstOrCreate([
            "user_id" => $user->id,
            "track_id" => $track->id,
        ]);

        $trackHistory->play_count += 1;
        $trackHistory->update();
        return;
    }
}
