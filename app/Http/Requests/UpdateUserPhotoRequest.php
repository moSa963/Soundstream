<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        $this->file("photo")->storeAs("user_photo", $this->user()->username);
    }

    public function rules(): array
    {
        return [
            "photo" => ["required", "image"],
        ];
    }
}
