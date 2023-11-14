<?php

namespace App\Services;

use Exception;
use getID3;
use Illuminate\Support\Facades\Log;

class AudioService {

    static function duration($path) : int | null {
        try {
            $id3 = new getID3();
            $info = $id3->analyze($path);
            return $info["playtime_seconds"];
        } catch (Exception $e) {
            return null;
        }
    }
}