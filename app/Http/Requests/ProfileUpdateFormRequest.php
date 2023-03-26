<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateFormRequest extends FormRequest
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
            // 自分のアドレスはバリデーション対象から除外する必要がある
            'mail' => 'required|string|email|min:5|max:40|unique:users,mail,'.$request->id.',id',
            'password' => 'required|string|min:8|max:20|confirmed',
            'bio' => 'max:150',
            'images' => 'mimes:jpg, png, bmp, gif, svg'
        ];
    }
}
