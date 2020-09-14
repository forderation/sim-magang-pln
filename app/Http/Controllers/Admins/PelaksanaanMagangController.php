<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use App\Models\Pelaksanaan;
use App\Models\SuratTerbit;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class PelaksanaanMagangController extends Controller
{
    public function index(){
        $magangs = Magang::where('status_pengajuan','diterima')->whereNotIn('id',function($query){
            $query->select('magang_id')->from('pelaksanaans');
        })->get();
        return view('admins.pelaksanaan', compact('magangs'));
    }

    public function submit(Request $request){
        $request->validate([
            'nomor_surat' => 'required|unique:surat_terbits',
        ]);

        $filename_surat = 'pelaksanaan-'.$request->nomor_surat.'.'.$request->file_surat->extension();
        $request->file('file_surat')->storeAs('pelaksanaan', $filename_surat);
        
        $id_surat = SuratTerbit::insertGetId([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_terbit' => $request->tanggal_terbit,
            'lokasi_simpan' => $filename_surat
        ]);

        $admin = Auth::guard('admin')->user();

        Pelaksanaan::create([
            'surat_pelaksanaan_id' => $id_surat,
            'magang_id' => $request->magang_id,
            'admin_id' => $admin->id,
            'status_magang' => $request->status_magang
        ]);

        return redirect()->back()->with('status','Berhasil menambahkan pelaksanaan peserta magang');
    }

    
    public function getFilePelaksanaan($id){
        $pelaksanaan = Pelaksanaan::find($id);
        return Storage::download('pelaksanaan\\'.$pelaksanaan->surat_terbit->lokasi_simpan);
    }
}