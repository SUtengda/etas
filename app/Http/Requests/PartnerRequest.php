<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
            'PAR_partner'=>'required',
            'PAR_contact'=>'required',
            'PAR_address'=>'required',
            'PAR_mobilePhone'=>'required',
            'PAR_email'=>'required|regex: /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/'
        ];
    }

    public function messages()
    {
        return [
            'PAR_partner.required'=>'合作方不能为空',
            'PAR_contact.required'=>'联系人不能为空',
            'PAR_address.required'=>'地址不能为空',
            'PAR_mobilePhone.required'=>'移动电话号码不能为空',
            'PAR_email.regex'=>'无效的邮箱'
        ];
    }
}
