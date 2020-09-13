<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller
{
    
    public function login_form(){
        return view('frontends.login');
    }

    public function login(Request $request){

    }

    public function register_form(){
        return view('frontends.register');
    }

    public function register(Request $request){

    }
}