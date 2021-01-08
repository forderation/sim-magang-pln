<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Group;
use App\Models\LocationMagang;
use App\Models\Magang;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ['lead_id', '=',$user->id],
            ['status_pengajuan', '=', 'proses']
        ])->get();
        
        if(!$check_user->isEmpty()){
            return redirect()->back()->with('status', 'Anda tidak diperkenankan mengajukan magang lebih dari satu kali');
        }

        $dateNow = Carbon::now();

        $check_user = Magang::where([
            ['lead_id', '=',$user->id],
            ['status_pengajuan', '=', 'diterima'],
            ['tanggal_selesai', '>', $dateNow]
        ])->get();

        if(!$check_user->isEmpty()){
            return redirect()->back()->with('status', 'Anda tidak diperkenankan mengajukan magang jika belum selesai');
        }

        $divisis = Divisi::where('location_magang_id', $id)->get();
        $users = User::where('id', '!=', Auth::user()->id)->get();

        $location = LocationMagang::find($id);
        return view($this->view_folder.'daftar', compact('location', 'divisis', 'users'));
    }

    public function getRangeDate(Request $request){
        if($request->has('divisi') && $request->has('startDate')){
            $from = Carbon::parse($request->startDate);
            // $magangs = Magang::where('divisi_id', $request->divisi)->where('status_pengajuan','diterima')
            // ->whereDate('tanggal_mulai', '>=' ,$from)->get();
            $details = Divisi::where('id', $request->divisi)->with(['magangs' => function($query) use ($from) {
                $query->where('status_pengajuan', 'diterima')
                ->whereDate('tanggal_mulai', '<=' ,$from)->get();
            }])->firstOrFail();
            return json_encode($details);
        }
        return json_encode([]);
    }

    public function getDivisi($id){
        $divisi = Divisi::where('id', $id)->with(['magangs' => function($query){
            $query->where('status_pengajuan', 'diterima')->count();
        }])->firstOrFail();
        // dd($divisi);
        return json_encode($divisi);
    }

    public function submit(Request $request){
        
        $user = Auth::user();
        $location = LocationMagang::find($request->location_magang_id);

        $filename_proposal = 'proposal-'.$location->nama_lokasi.'-'.$user->no_induk.'-'.$user->full_name.'.'.$request->proposal->extension();
        $request->file('proposal')->storeAs('proposal', $filename_proposal);

        $filename_surat = 'surat permohonan-'.$location->nama_lokasi.'-'.$user->no_induk.'-'.$user->full_name.'.'.$request->surat_pemohon->extension();
        $request->file('surat_pemohon')->storeAs('surat_permohonan', $filename_surat);


        $jangka_waktu = Carbon::parse($request->tanggal_mulai)->diffInDays(Carbon::parse($request->tanggal_selesai));
        
        
        $magang = Magang::create([
            'lead_id' => $user->id,
            'divisi_id' => $request->divisi_id,
            'surat_pemohon' => $filename_surat,
            'proposal' => $filename_proposal,
            'jangka_waktu' => $jangka_waktu,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);
        
        $groups = $request->groups;

        foreach($groups as $g){
            Group::create([
                'magang_id' => $magang->id,
                'user_id' => $g,
            ]);
        }
        Group::create([
            'magang_id' => $magang->id,
            'user_id' => $user->id,
        ]);

        return redirect(route('pengajuan-magang.index'))->with('status','Pengajuan magang berhasil didaftarkan');
    }
}