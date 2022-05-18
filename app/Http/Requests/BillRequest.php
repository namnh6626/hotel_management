<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
            'rooms'=>'required',
            'customer'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'rooms.required'=>'Phải chọn ít nhất một phòng',
            'customer.required'=>'Phải chọn khách hàng'
        ];
    }
}
