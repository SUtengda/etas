<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthticationController extends Controller
{
    public function getLogin(){
        return view('login');
    }

    /**
     * 处理身份认证尝试.
     *
     */
    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // 认证通过...
            $user = Auth::guard()->user();
            $user->generateToken();
            return redirect('/');

        }else{
            return redirect('/login')->with(['error' => '账户密码不匹配','pwd'=>bcrypt($request->password)]);
        }


    }
    public function reset(ResetPasswordRequest $request){
        $user = Auth::guard()->user();

        if($user){
            $user->password = Hash::make($request->input('newpwd'));
            $user->save();
            return response()->json(['success'=>'密码已重置'], 201);
        }else{
            return response()->json(['error' => '账户有误，请重新登陆后尝试'], 403);
        }
    }

    public function logout(){
        $user = Auth::guard()->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }
        Auth::logout();
        //return redirect('/login');
        return response()->json(['msg' => 'User logged out.'], 200);
    }
}
