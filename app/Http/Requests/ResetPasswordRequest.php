<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'currentpwd'=>'required',
            'newpwd'=>'required|different:currentpwd',
            'renewpwd'=>'required|same:newpwd',
        ];
    }

    public function messages()
    {
        return [
            'currentpwd.required'=>'没有提供当前用户密码',
            'newpwd.required'=>'请输入新密码',
            'renewpwd.required'=>'请二次输入新密码',
            'renewpwd.different'=>'新密码与旧密码相同',
            'renewpwd.same'=>'两次密码不匹配',
        ];
    }
}
