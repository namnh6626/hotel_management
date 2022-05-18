<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>'required|string',
            'email'=>'required|email|unique:users,user_email',
            'phone'=>'required|numeric',
            'password'=>'required|confirmed|min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Tên nhân viên không được trống',
            'name.string'=>'Tên nhân viên không hợp lệ',
            'email.required'=>'Email không được trống',
            'email.email'=>'Email không hợp lệ',
            'email.unique'=>'Email đã tồn tại',
            'phone.required'=>'Số điện thoại không được trống',
            'phone.numeric'=>'Số điện thoại không hợp lệ',
            'password.required'=>'Mật khẩu không được trống',
            'password.confirmed'=>'Giá trị hai ô mật khẩu và nhập lại không trùng nhau',
            'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự',

        ];
    }
}
