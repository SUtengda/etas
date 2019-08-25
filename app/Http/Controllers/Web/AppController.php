<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;

class AppController extends Controller
{
    public function index() {

        /*
         * {
         *  "id":1,
         *  "name":"root",
         *  "email":"root@etas.com",
         *  "email_verified_at":"2019-08-20 23:52:54",
         *  "api_token":"AHdtT2TTztMgkJ3vB7229aGR8OsXCqDNDTxj5PIvcqdEUZVsm1weXk4hWXGw",
         *  "created_at":"2019-08-20 23:53:20",
         *  "updated_at":"2019-08-25 11:03:09"
         * }
         */
        $user = Auth::guard()->user();
        return view('app',compact('user'));
    }


}
