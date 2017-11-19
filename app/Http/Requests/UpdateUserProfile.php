<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->role !== 'admin' && auth()->id() != $this->route('user')->id) {
            return false;
        }

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
            'bio' => 'nullable|string',
            'airport_code' => 'nullable|size:3',
            'twitter_handle' => 'nullable|min:1|max:15',
            'url' => 'nullable|url',
            'desire_transportation' => 'nullable|boolean',
            'desire_accommodation' => 'nullable|boolean',
            'is_sponsor' => 'nullable|boolean'
        ];
    }
}
