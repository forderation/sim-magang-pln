<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use App\Models\Pelaksanaan;
use App\Models\SuratTerbit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class PelaksanaanMagangController extends Controller
{
    public function index(){
        $magangs = Magang::where('status_pengajuan','diterima')->whereNotIn('id',function($query){
            $query->select('magang_id')->from('pelaksanaans');
        })->get();
        $pelaksanaans = Pelaksanaan::all();
        return view('admins.pelaksanaan', compact('magangs','pelaksanaans'));
    }

    public function submit(Request $request){
        $request->validate([
            'nomor_surat' => 'required|unique:surat_terbits',
        ]);

        $filename_surat = 'pelaksanaan-'.$request->file_surat->getClientOriginalName().'.'.$request->file_surat->extension();
        $request->file('file_surat')->storeAs('pelaksanaan', $filename_surat);
        
        $surat = SuratTerbit::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_terbit' => $request->tanggal_terbit,
            'lokasi_simpan' => $filename_surat
        ]);

        $admin = Auth::guard('admin')->user();

        Pelaksanaan::create([
            'surat_pelaksanaan_id' => $surat->id,
            'magang_id' => $request->magang_id,
            'admin_id' => $admin->id,
            'status_magang' => $request->status_magang
        ]);

        return redirect()->back()->with('status','Berhasil menambahkan pelaksanaan peserta magang');
    }

    public function update(Request $request){
        $pelaksanaan = Pelaksanaan::find($request->id);
        $request->validate([
            'nomor_surat' => 'required|unique:surat_terbits,nomor_surat,'.$pelaksanaan->surat_terbit->id,
        ]);

        if($request->file_surat != null){
            Storage::delete('pelaksanaan\\'.$pelaksanaan->surat_terbit->lokasi_simpan);
            $filename_surat = 'pelaksanaan-'.$request->file_surat->getClientOriginalName().'.'.$request->file_surat->extension();
            $request->file('file_surat')->storeAs('pelaksanaan', $filename_surat);
            $pelaksanaan->surat_terbit->update(['lokasi_simpan'=>$filename_surat]);
        }

        $pelaksanaan->surat_terbit->update(['nomor_surat'=>$request->nomor_surat,'tanggal_terbit'=>$request->tanggal_terbit]);
        
        $pelaksanaan->update(['status_magang'=>$request->status_magang]);
        return redirect()->back()->with('status','Berhasil memperbarui pelaksanaan peserta');
    }
    
    public function getFilePelaksanaan($id){
        $pelaksanaan = Pelaksanaan::where('id',$id)->with(['surat_terbit'])->get()[0];
        return Storage::download('pelaksanaan\\'.$pelaksanaan->surat_terbit->lokasi_simpan);
    }
}