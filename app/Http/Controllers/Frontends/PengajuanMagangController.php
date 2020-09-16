<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\Models\LocationMagang;
use App\Models\Magang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class PengajuanMagangController extends Controller
{
    protected $view_folder = 'frontends.pengajuan-magang.';

    public function index(){
        $lokasis = LocationMagang::all();
        return view($this->view_folder.'index', compact('lokasis'));
    }


    public function daftar($id){
        $user = Auth::user();
        $check_user = Magang::where([
            ['user_id', '=',$user->id],
            ['status_pengajuan', '=', 'proses']
        ])->get();
        
        if(!$check_user->isEmpty()){
            return redirect()->back()->with('status', 'Anda tidak diperkenankan mengajukan magang lebih dari satu kali');
        }

        $dateNow = Carbon::now();

        $check_user = Magang::where([
            ['user_id', '=',$user->id],
            ['status_pengajuan', '=', 'diterima'],
            ['tanggal_selesai', '>', $dateNow]
        ])->get();

        if(!$check_user->isEmpty()){
            return redirect()->back()->with('status', 'Anda tidak diperkenankan mengajukan magang jika belum selesai');
        }

        $location = LocationMagang::find($id);
        return view($this->view_folder.'daftar', compact('location'));
    }

    public function submit(Request $request){
        $user = Auth::user();
        $location = LocationMagang::find($request->location_magang_id);

        $filename_proposal = 'proposal-'.$location->nama_lokasi.'-'.$user->no_induk.'-'.$user->full_name.'.'.$request->proposal->extension();
        $request->file('proposal')->storeAs('proposal', $filename_proposal);

        $filename_surat = 'surat permohonan-'.$location->nama_lokasi.'-'.$user->no_induk.'-'.$user->full_name.'.'.$request->surat_pemohon->extension();
        $request->file('surat_pemohon')->storeAs('surat_permohonan', $filename_surat);

        $tanggal_selesai = Carbon::parse($request->tanggal_mulai)->addDays($request->jangka_waktu);
        
        Magang::create([
            'user_id' => $user->id,
            'location_magang_id' => $location->id,
            'surat_pemohon' => $filename_surat,
            'proposal' => $filename_proposal,
            'jangka_waktu' => $request->jangka_waktu,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
        ]);

        return redirect(route('pengajuan-magang.index'))->with('status','Pengajuan magang berhasil didaftarkan');
    }
}