<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\LocationMagang;
use Symfony\Component\HttpFoundation\Request;

class LokasiMagangController extends Controller
{

    protected $view_folder = 'admins.lokasi_magang.';

    public function index(){
        
        $lokasis = LocationMagang::with(['magangs' => function($query){
            return $query->with(['pelaksanaan' => function($query){
                return $query->where('status_magang', 'aktif')->get();
            }])->get();
        }
        ])->get();

        return view($this->view_folder.'index', compact('lokasis'));
    }

    public function store(Request $request){
        LocationMagang::create($request->except('_token','method'));
        return redirect()->back()->with('status','Berhasil menambahkan lokasi baru');
    }
}