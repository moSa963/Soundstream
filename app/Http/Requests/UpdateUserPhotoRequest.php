<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateUserPhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function update(): void
    {
        $path = $this->file("photo")->store("user_photo", 'local');

        abort_if(!$path, 400, "Couldn't save the photo");

        if ($this->user()->photo != null) {
            Storage::delete("user_photo/{$this->user()->photo}");
        }

        $this->user()->update([
            "photo" => explode('/', $path, 2)[1],
        ]);
    }

    public function rules(): array
    {
        return [
            "photo" => ["required", "image"],
        ];
    }
}
