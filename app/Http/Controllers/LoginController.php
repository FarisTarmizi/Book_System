<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    function login_home()
    {
        return view('auth.home', ['nme' => 'BOOK SYSTEM']);
    }

    function test()
    {
        return view('management/layout/main');
    }
}
