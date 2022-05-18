<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'cus_name'=>'required|string',
            'cus_email'=>'required|email|unique:customers,cus_email',
            'phone'=>'required|numeric',
            'citizen_id'=> 'required|numeric',
            'address'=> 'string|required'
        ];
    }

    public function messages()
    {
        return [
            'cus_name.required'=>'Tên khách hàng không được trống',
            'cus_name.string'=>'Tên khách hàng không hợp lệ',
            'cus_email.required'=>'Email không được trống',
            'cus_email.email'=>'Email không hợp lệ',
            'cus_email.unique'=>'Email đã tồn tại',
            'citizen_id.required'=>'Số CMT/CCCD không được trống',
            'address.required'=>'Địa chỉ khách hàng không được trống',
            'citizen_id.numeric'=>'Số CMT/CCCD khách hàng không hợp lệ',
            'phone.required'=>'Số điện thoại không được trống',
            'phone.numeric'=>'Số điện thoại không hợp lệ',
        ];
    }
}
