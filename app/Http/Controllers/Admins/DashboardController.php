<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    public function index(){
        $magangs = Magang::where('status_pengajuan','proses')->with(['user'])->get();
        return view('admins.dashboard', compact('magangs'));
    }

    public function setujui_proposal($id){
        Magang::find($id)->update([
            'status_pengajuan' => 'diterima'
        ]);
        return redirect()->back()->with('status','berhasil melakukan persetujuan proposal');
    }

    public function tolak_proposal($id){
        Magang::find($id)->update([
            'status_pengajuan' => 'ditolak'
        ]);
        return redirect()->back()->with('status','berhasil melakukan penolakan proposal');
    }
}