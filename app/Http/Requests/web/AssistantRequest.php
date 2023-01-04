<?php

namespace App\Http\Requests\web;

use App\Rules\isValidPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AssistantRequest extends FormRequest
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

        if ($this->isMethod('POST')) return $this->store();
        elseif ($this->isMethod('PUT')) return $this->update();
    }
    private function update()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|unique:users,email,' . $this->route('user')->id,
            'password' => [
                'nullable',
                'confirmed',
                new isValidPassword()
            ],
            'phone' => 'required|unique:users,phone,' . $this->route('user')->id,
            'image' => 'nullable|image|mimes:png,jpg',
        ];
    }
    private function store()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                new isValidPassword()
            ],
            'phone' => 'required|unique:users,phone',
            'image' => 'nullable|image|mimes:png,jpg',
        ];
    }
}
