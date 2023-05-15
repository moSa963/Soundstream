<?php

namespace App\Http\Requests;

use App\Models\Track;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTrackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }
    
    public function update(Track $track)
    {
        $track->update($this->validated());

        return $track;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "title" => ["string", "min:3", "max:255"],
            "explicit" => ["boolean"],
            "written_by" => ["string"],
            "performed_by" => ["string"],
        ];
    }
}
