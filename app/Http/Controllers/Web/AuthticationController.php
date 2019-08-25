<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            return response()->json(['error' => 'no user.'],401);
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
