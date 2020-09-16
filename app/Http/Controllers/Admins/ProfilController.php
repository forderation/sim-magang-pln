<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends Controller
{
    public function index(){
        $user = Auth::guard('admin')->user();
        return view('admins.profil', compact('user'));
    }

    public function update_profil(Request $request){
        $user =  Auth::guard('admin')->user();
        $request->validate([
            'email' => 'required|unique:admins,email,'.$user->id,
        ]);
        $user->update($request->except('_token','method'));
        return redirect()->back()->with('status','Berhasil memperbarui profil');
    }

    public function update_password(Request $request){
        $user = Auth::guard('admin')->user();
        if(!Hash::check($request->old_password,$user->password)) {
            return redirect()->back()->with('status','Gagal memperbarui password lama tidak sama');
        }
        $new_pass = Hash::make($request->password);
        $user->update(['password'=>$new_pass]);
        return redirect()->back()->with('status','Berhasil memperbarui password');
    }
    
}