<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller
{
    
    public function login_form(){
        if (!Auth::check()) {
            return view('frontends.login');
        }
        return redirect(route('index'));
    }

    public function login(Request $request){

    }

    public function register_form(){
        if (!Auth::check()) {
            return view('frontends.register');
        }
        return redirect(route('index'));
    }

    public function register(Request $request){
        $request->validate([
            'email' => 'required|unique:users',
        ]);

        User::create(
            $request->except('_token','method','password_confirmation')
        );

        return redirect()->back()->with('status', 'Berhasil mendaftarkan akun!');
    }
}