@extends('layouts.frontend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Sertifikat</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">App</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('admin.index')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="#">Sertifikat</a>
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
    Anda belum mendapatkan sertifikat magang
</div>
@endif

<!-- Page Content -->
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Daftar mendapatkan sertifikat</h3>
                </div>
                <div class="block-content">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Sekolah</th>
                                <th>Lokasi</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Nomor Sertifikat</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sertifikats as $sertifikat)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$sertifikat->magang->user->full_name}}</td>
                                <td>{{$sertifikat->magang->user->sekolah}}</td>
                                <td>{{$sertifikat->magang->location_magang->nama_lokasi}}</td>
                                <td>
                                    {{$sertifikat->magang->tanggal_mulai}}
                                </td>
                                <td>
                                    {{$sertifikat->magang->tanggal_selesai}}
                                </td>
                                <td>
                                    {{$sertifikat->surat_terbit->nomor_surat}}
                                </td>
                                <td>
                                    <a href="{{route('sertifikat-magang.file',['id' => $sertifikat->id])}}" target="_blank" class="btn btn-block btn-info btn-sm">sertifikat</a>
                                    
                                    <button type="button" class="btn modal-status-btn btn-warning btn-block btn-sm"
                                    data-nomor=" {{$sertifikat->surat_terbit->nomor_surat}}" data-tanggal="{{$sertifikat->surat_terbit->tanggal_terbit}}"
                                     data-id="{{$sertifikat->id}}" data-nama="{{$sertifikat->magang->user->full_name}}">edit</button>
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