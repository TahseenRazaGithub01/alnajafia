<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IslamicCategoryRequest extends FormRequest
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
            'category_name_en'              => 'required',
            'category_description_en'       => 'required',
            'banner_image'                  => 'image|required|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
