<?php

namespace App\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StreamService
{

    public static function download($storage_path, $range, $name): BinaryFileResponse
    {
		$fullsize = Storage::size($storage_path);;
		$size = $fullsize;

		$response_code = 200;
		$headers = ["Content-type" => Storage::mimeType($storage_path)];
		$headers["Content-Disposition"] = "inline; filename=" . '"' . $name . '"';

		if ($range != null) {
			list($unit, $val) = explode("=", $range);
			list($start, $end) = explode("-", $val);

			$end = $end == "" ? $fullsize - 1 : $end;

            $size = $fullsize - $start;
            $response_code = 206;
            $headers["Accept-Ranges"] = $unit;
            $headers["Content-Range"] = $unit . " " . $start . "-" . $end . "/" . $fullsize;
		}

		$headers["Content-Length"] = $size;

        return new BinaryFileResponse(Storage::path($storage_path), $response_code, $headers, false);
    }
}