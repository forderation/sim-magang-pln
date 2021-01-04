<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\LocationMagang;
use Symfony\Component\HttpFoundation\Request;

class LokasiMagangController extends Controller
{

    protected $view_folder = 'admins.lokasi_magang.';

    public function index(){
        $peserta_aktif = [];
        $peserta_non_aktif = [];
        $lokasis = LocationMagang::all();
        // foreach($lokasis as $lokasi){
        //     $aktif = 0;
        //     $non_aktif = 0;
        //     foreach($lokasi->magangs as $magang){
        //         if($magang->pelaksanaan != null){
        //             if($magang->pelaksanaan->status_magang == 'aktif'){
        //                 $aktif += 1;
        //             }else{
        //                 $non_aktif += 1;
        //             }
        //         }
        //     }
        //     array_push($peserta_aktif, $aktif);
        //     array_push($peserta_non_aktif, $non_aktif);
        // }
        return view($this->view_folder.'index', compact('lokasis', 'peserta_aktif', 'peserta_non_aktif'));
    }

    public function store(Request $request){
        LocationMagang::create($request->except('_token','method'));
        return redirect()->back()->with('status','Berhasil menambahkan lokasi baru');
    }

    public function edit(Request $request){
        LocationMagang::where('id',$request->id)->update($request->except('_token','method', 'id'));
        return redirect()->back()->with('status','Berhasil memperbarui lokasi');
    }

    public function delete(Request $request){
        LocationMagang::where('id',$request->id)->delete();
        return redirect()->back()->with('status','Berhasil menghapus lokasi');
    }
}