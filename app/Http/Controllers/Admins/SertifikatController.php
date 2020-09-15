<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use App\Models\Sertifikat;
use App\Models\SuratTerbit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class SertifikatController extends Controller
{
    public function index(){
        $date_now = Carbon::now();
        $magangs = Magang::where('status_pengajuan','diterima')->where([['tanggal_selesai', '<', $date_now]])
        ->whereNotIn('id', function($query){
            $query->select('magang_id')->from('sertifikats');
        })->whereIn('id', function($query){
            $query->select('magang_id')->from('pelaksanaans');
        })->get();
        $sertifikats = Sertifikat::all();
        return view('admins.sertifikat', compact('magangs','sertifikats'));
    }

    public function submit(Request $request){
        $request->validate([
            'nomor_surat' => 'required|unique:surat_terbits',
        ]);
        
        if(SuratTerbit::latest()->first() == null){
            $id_new = 1;
        }else{
            $id_new = SuratTerbit::latest()->first()->id + 1;
        }

        $filename = 'sertifikat-'.$id_new.'-'.$request->file_sertifikat->getClientOriginalName().'.'.$request->file_sertifikat->extension();
        $request->file('file_sertifikat')->storeAs('sertifikat', $filename);
        
        $surat = SuratTerbit::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_terbit' => $request->tanggal_terbit,
            'lokasi_simpan' => $filename
        ]);

        $admin = Auth::guard('admin')->user();

        Sertifikat::create([
            'surat_sertifikat_id' => $surat->id,
            'magang_id' => $request->magang_id,
            'admin_id' => $admin->id
        ]);

        return redirect()->back()->with('status','Berhasil menambahkan sertifikat peserta magang');
    }

    public function update(Request $request){
        $cert = Sertifikat::find($request->id);
        $request->validate([
            'nomor_surat' => 'required|unique:surat_terbits,nomor_surat,'.$cert->surat_terbit->id,
        ]);

        if($request->file_sertifikat != null){
            Storage::delete('sertifikat\\'.$cert->surat_terbit->lokasi_simpan);
            $filename_surat = 'sertifikat-'.$cert->surat_terbit->id.'-'.$request->file_sertifikat->getClientOriginalName().'.'.$request->file_sertifikat->extension();
            $request->file('file_sertifikat')->storeAs('sertifikat', $filename_surat);
            $cert->surat_terbit->update(['lokasi_simpan'=>$filename_surat]);
        }

        $cert->surat_terbit->update(['nomor_surat'=>$request->nomor_surat,'tanggal_terbit'=>$request->tanggal_terbit]);
        return redirect()->back()->with('status','Berhasil memperbarui sertifikat peserta');
    }
    
    public function getFileSertifikat($id){
        $cert = Sertifikat::where('id',$id)->with(['surat_terbit'])->get()[0];
        return Storage::download('sertifikat\\'.$cert->surat_terbit->lokasi_simpan);
    }
}