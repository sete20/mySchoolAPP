<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Concerns\WithHashedPassword;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'name' => 'required|min:8',
            'phone' => 'required|unique:users,phone',
            'image' => 'nullable|image|mimes:png,jpg'
        ];
    }
}
