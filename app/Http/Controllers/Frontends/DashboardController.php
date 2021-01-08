<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Magang;
use App\Models\Pelaksanaan;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    
    public function index(){
        return redirect(route('home.index'));
    }

    public function home(){
        $user = Auth::user();
        $magangs = Group::whereHas('magang')->with('magang')->where('user_id', $user->id)->get();
        return view('frontends.dashboard', compact('magangs'));
    }
    
    public function getFileProposal($id_magang){
        $magang = Magang::find($id_magang);
        return Storage::download('proposal\\'.$magang->proposal);
    }

    public function getFileSP($id_magang){
        $magang = Magang::find($id_magang);
        return Storage::download('surat_permohonan\\'.$magang->surat_pemohon);
    }

    public function profil_form(){
        $user = Auth::user();
        return view('frontends.profil', compact('user'));
    }

    public function sertifikat(){
        $user = Auth::user();
        $magangs= $user->magangs->pluck('id');
        $sertifikats = Sertifikat::whereIn('magang_id',$magangs)->get();
        return view('frontends.sertifikat', compact('sertifikats'));
    }

    public function pelaksanaan(){
        $user = Auth::user()->first();
        $magangs= $user->magangs->pluck('id');
        $pelaksanaans = Pelaksanaan::whereIn('magang_id',$magangs)->get();
        return view('frontends.pelaksanaan', compact('pelaksanaans'));
    }

    public function update_profil(Request $request){
        $user = Auth::user();
        $request->validate([
            'email' => 'required|unique:users,email,'.$user->id,
        ]);
        $user->update($request->except('_token','method'));
        return redirect()->back()->with('status','Berhasil memperbarui profil');
    }

    public function update_password(Request $request){
        $user = Auth::user();
        if(!Hash::check($request->old_password,$user->password)) {
            return redirect()->back()->with('status','Gagal memperbarui password lama tidak sama');
        }
        $new_pass = Hash::make($request->password);
        $user->update(['password'=>$new_pass]);
        return redirect()->back()->with('status','Berhasil memperbarui password');
    }
}