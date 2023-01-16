<?php

namespace App\Http\Requests\Web;

use App\Models\Lesson;
use App\Models\SubUnit;
use Illuminate\Foundation\Http\FormRequest;

class SocialMediaPlatformRequest extends FormRequest
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
            'account_url' => 'required|url',
            'platform_name' => 'required|string',
        ];
    }
}
