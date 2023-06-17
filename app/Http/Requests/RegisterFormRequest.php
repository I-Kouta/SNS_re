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
            'mail' => 'required|string|email|min:5|max:40|unique:users,mail',
            'password' => 'required|string|min:8|max:20|confirmed'
        ];
    }

    public function messages(){
        return [
            "username.required" => "名前の入力は必須です",
            "username.string" => "名前の入力された内容の形式が異なります",
            "username.min" => "名前は2文字以上での入力が必須です",
            "username.max" => "名前は12文字以内での入力が必須です",
            "mail.required" => "アドレスの入力は必須です",
            "mail.string" => "入力されたアドレスの内容の形式が異なります",
            "mail.email" => "アドレスの形式で入力されていません",
            "mail.min" => "アドレスは5文字以上での入力が必須です",
            "mail.max" => "アドレスは40文字以内での入力が必須です",
            "mail.unique" => "すでに使用されているアドレスです",
            "password.required" => "パスワードの入力は必須です",
            "password.string" => "パスワードの入力された内容の形式が異なります",
            "password.min" => "パスワードは8文字以上での入力が必須です",
            "password.max" => "パスワードは20文字以内での入力が必須です",
            "password.confirmed" => "パスワードが一致していません",
        ];
    }
}
