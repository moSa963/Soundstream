<?php

namespace App\Http\Requests;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePlaylistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function store(User $user)
    {
        return Playlist::create([
            'user_id' => $user->id,
            'title' => $this->validated("title"),
            'description' => $this->validated("title", ""),
            'album' => false,
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:1500'],
        ];
    }
}
