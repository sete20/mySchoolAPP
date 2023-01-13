<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            'price' => 'required|integer',
            'status' => 'required|in:0,1',
            'duration' => 'required|integer',
            'units_id' => 'array|required',
            'units_id.*' => 'exists:units,id'
        ];
    }
}
