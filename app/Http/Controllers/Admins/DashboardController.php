<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    public function index(){
        $pelaksanaans = Magang::where('status_pengajuan','diterima')->whereNotIn('id',function($query){
            $query->select('magang_id')->from('pelaksanaans');
        })->get();
        $proposals = Magang::where('status_pengajuan','proses')->with(['leader', 'users'])->get();
        return view('admins.dashboard', compact('pelaksanaans','proposals'));
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