@extends('layouts.frontend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Dashboard</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">App</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Dashboard</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Daftar Lokasi Magang, anda hanya diperkenankan daftar pada satu lokasi</h3>
                </div>
                <div class="block-content">
                    @if (session('status'))
                    <div class="alert alert-warning">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 40px;">#</th>
                                <th>Nama Lokasi</th>
                                <th>Alamat</th>
                                <th>Jumlah peserta magang saat ini</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lokasis as $lokasi)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="font-w600">
                                    {{$lokasi->nama_lokasi}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{$lokasi->alamat}}
                                </td>
                                <td>
                                    {{$lokasi->magangs->count()}}
                                </td>
                                <td>
                                    <a href="{{route('pengajuan-magang.daftar',['id'=>$lokasi->id])}}" class="btn btn-primary btn-sm"> daftar </a>                                    
                                    @if($lokasi->latitude != null && $lokasi->longitude != null)
                                        <a href="{{'https://www.google.com/maps/@'.$lokasi->latitude.','.$lokasi->longitude}}." target="_blank" class="btn btn-info btn-sm"> maps </a>
                                    @endif
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
<!-- END Page Content -->
@endsection

@section('js_after')

@endsection