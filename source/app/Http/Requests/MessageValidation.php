<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageValidation extends FormRequest
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
            'title' => 'required|string|max:50',
            'content' => 'required|string|between:2,255'
        ];
    }

    public function messages()
{
    return [
        'required' => ':attribute 未填。',
        'string' => ':attribute 格式不支援。',
        'between' => ':attribute 文字長度請在:min至:max間。',
        'max' => ':attribute 文字長度請在:max以內。',
    ];
}

}
