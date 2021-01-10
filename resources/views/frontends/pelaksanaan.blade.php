@extends('layouts.frontend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Pelaksanaan</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">App</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('index')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="#">Pelaksanaan</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

@if (session('status'))
<div class="alert alert-warning">
    {{ session('status') }}
</div>
@endif

@if($pelaksanaans->isEmpty())
<div class="alert alert-warning">
    Anda belum mendapatkan pelaksanaan magang
</div>
@endif

<!-- Page Content -->
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Daftar pelaksanaan magang</h3>
                </div>
                <div class="block-content">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Koordinator</th>
                                <th>Lokasi</th>
                                <th>Divisi</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Nomor Surat</th>
                                <th>Status Pelaksanaan</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelaksanaans as $pelaksanaan)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$pelaksanaan->magang->leader->full_name}}</td>
                                <td>{{$pelaksanaan->magang->divisi->location_magang->nama_lokasi}}</td>
                                <td>{{$pelaksanaan->magang->divisi->nama_divisi}}</td>
                                <td>
                                    {{$pelaksanaan->magang->tanggal_mulai}}
                                </td>
                                <td>
                                    {{$pelaksanaan->magang->tanggal_selesai}}
                                </td>
                                <td>
                                    {{$pelaksanaan->surat_terbit->nomor_surat}}
                                </td>
                                <td>
                                    <h3><span class="badge align-middle {{$pelaksanaan->status_magang == 'aktif'? 'badge-success':'badge-warning'}}">{{$pelaksanaan->status_magang}}</span></h3>
                                </td>
                                <td>
                                    <a href="{{route('pelaksanaan-magang.file',['id' => $pelaksanaan->id])}}" target="_blank" class="btn btn-block btn-info btn-sm">surat</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_after')
@endsection