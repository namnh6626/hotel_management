<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email_phone'=>'required|email',
            'password'=>'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'email_phone.required' => 'Bạn cần điền email',
            'email_phone.email' => "Email không hợp lệ",
            'password.required' => 'Bạn cần điền mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ];
    }
}
