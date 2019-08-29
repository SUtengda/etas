<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getUsers(){
        return response()->json(User::all());
    }
    public function postUser(Request $request){
        try {
            // 规则
            $rules = [
                'name' => 'required|max:10',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ];

            // 自定义消息
            $messages = [
                'name.required' => '请输入用户名',
                'name.max' => '用户名的长度不能超过10个字符',
                'email.required' => '请输入邮箱',
                'email.email' => '请输入正确的邮箱格式',
                'email.unique' => '该用户已存在',
            ];

            $this->validate($request, $rules, $messages);

            $name = $request->input('name');
            $email = $request->input('email');
            $password =  $request->input('userPsd');

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = bcrypt($password);
            $user->save();

            return response()->json(['user'=>$user,'randomPsw'=>$password], 201);
        } catch (ValidationException $validationException) {
            $message = $validationException->validator->getMessageBag()->first();
            return $message;
        }
    }
}
