<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        if (Auth::attempt(
            ['email' => $request->email, 'password' => $request->password],
            $request->remember
        )) { 
            return redirect(route('index'));
        }
        return redirect()->back()->with('status', 'Email atau password salah!');
    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'));
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
        $user = User::create(
            $request->except('_token','method','password_confirmation')
        );
        $user->update(['password' => Hash::make($request->password)]);
        return redirect()->back()->with('status', 'Berhasil mendaftarkan akun!');
    }
}