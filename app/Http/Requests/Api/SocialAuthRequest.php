<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SocialAuthRequest extends FormRequest
{
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
            'email' => 'required',
            'password' => 'nullable|min:8',
            'name' => 'required|min:8',
            'phone' => 'nullable|unique:users,phone',
            'image' => 'nullable|image|mimes:png,jpg',
            'provider_id' => 'required',
            'provider_name' => 'required|in:facebook,google'
        ];
    }
}
