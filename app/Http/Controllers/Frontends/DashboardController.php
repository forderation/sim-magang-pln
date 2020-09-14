<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    
    public function index(){
        return redirect(route('home.index'));
    }

    public function home(){
        $user = Auth::user();
        $magangs = Magang::where('user_id',$user->id)->with(['location_magang'])->get();
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
}