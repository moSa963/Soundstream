<?php

namespace App\Services;

use getID3;
use Illuminate\Support\Facades\Log;

class AudioService {

    static function duration($path) : int {
        $id3 = new getID3();

        $info = $id3->analyze($path);
 
        return $info["playtime_seconds"];
    }
}