<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TalkRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string|min:140',
            'additional_information' => 'nullable|string',
            'duration' => 'required|numeric',
            'slide' => 'nullable|url',
            'is_favorite' => 'boolean'
        ];
    }
}
