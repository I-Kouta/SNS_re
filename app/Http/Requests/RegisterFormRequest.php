<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|email|min:5|max:40|unique:users',
            'password' => 'required|string|min:8|max:20|confirmed'
        ];
    }

    public function messages(){
        return [
            "username.required" => "入力必須です",
            "username.string" => "入力された内容の形式が異なります",
            "username.min" => "2文字以上での入力が必須です",
            "username.max" => "12文字以内での入力が必須です",
        ];
    }
}
