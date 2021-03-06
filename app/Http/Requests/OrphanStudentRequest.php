<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrphanStudentRequest extends FormRequest
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
            'name'                          => 'required',
            'gender'                        => 'required',
            'orphan_type'                   => 'required',
            'cast'                          => 'required',
            'orp_profile_id'             => 'required',
            'orphan_profile_picture'        => 'image|required|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
