<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\LocationMagang;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index($id){
        $divisis = Divisi::where('location_magang_id', $id)->get();
        $lm = LocationMagang::where('id', $id)->first();
        return view('admins.divisi.index', compact('divisis', 'lm'));
    }

    public function store(Request $request){
        Divisi::create($request->except('_token','method'));
        return redirect()->back()->with('status','Berhasil menambahkan divisi baru');
    }

    public function edit(Request $request){
        Divisi::where('id',$request->id)->update($request->except('_token','method', 'id'));
        return redirect()->back()->with('status','Berhasil memperbarui divisi');
    }

    public function delete(Request $request){
        Divisi::where('id',$request->id)->delete();
        return redirect()->back()->with('status','Berhasil menghapus divisi');
    }
}