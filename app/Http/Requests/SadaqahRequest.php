<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SadaqahRequest extends FormRequest
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
            'detail_name_en'        => 'required',
            'description_en'        => 'required',
            'page_image'            => 'image|required|mimes:jpeg,png,jpg,gif,svg',
            'banner_image'          => 'image|required|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
