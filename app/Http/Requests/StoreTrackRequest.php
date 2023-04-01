<?php

namespace App\Http\Requests;

use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreTrackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function store(User $user) : Track
    {
        $path = $this->file("track")->store("tracks", 'local');

        abort_if(!$path, 400, "Couldn't save the track"); 

        return Track::create([
            'user_id' => $user->id,
            'title' => $this->validated("title"),
            'location' => explode('/', $path, 2)[1],
            'duration' => 0,
            'explicit' => $this->validated("explicit", false),
            'written_by' => $this->validated("written_by", ""),
            'performed_by' => $this->validated("performed_by", ""),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "title" => ["required", "string", "min:3", "max:255"],
            "explicit" => ["boolean"],
            "written_by" => ["string"],
            "performed_by" => ["string"],
            "track" => ["required", "file", "mimetypes:audio/mpeg,audio/mpga,audio/mp3,audio/wav"],
        ];
    }
}
