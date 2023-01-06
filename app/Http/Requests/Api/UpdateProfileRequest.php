<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Concerns\WithHashedPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    use WithHashedPassword;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password' => 'required|min:8',
            'name' => 'required|min:8',
            'image' => 'nullable|image|mimes:png,jpg'
        ];
    }
}
