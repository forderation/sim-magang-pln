<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller
{

    public function login_form()
    {
        if (Auth::guard('admin')->check()) {
            return redirect(route('admin.index'));
        }
        return view('admins.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }

    public function login(Request $request)
    {
        if (Auth::guard('admin')->attempt(
            ['email' => $request->email, 'password' => $request->password],
            $request->remember
        )) { 
            return redirect(route('admin.index'));
        }
        return redirect()->back()->with('status', 'Email atau password salah!');
    }
}
