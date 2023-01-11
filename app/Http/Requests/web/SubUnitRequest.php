<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class SubUnitRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'unit_id' => 'required|exists:units,id',
            'status' => 'required|in:0,1',
        ];
    }
}
