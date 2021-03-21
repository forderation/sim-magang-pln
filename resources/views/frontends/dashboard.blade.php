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
                        <h3 class="block-title">Status Magang Anda</h3>
                    </div>
                    <div class="block-content">
                    <table class="table table-responsive table-bordered table-striped table-vcenter js-dataTable-full" style="max-width: 100%; overflow-x: scroll;">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 40px;">#</th>
                                <th>Lokasi</th>
                                <th>Bagian</th>
                                <th>Tanggal Mulai Magang</th>
                                <th>Tanggal Selesai Magang</th>
                                <th>Durasi (Hari)</th>
                                <th>Status Pengajuan</th>
                                <th>Pelaksana</th>
                                <th style="width: 25%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($magangs as $magang)
                            <tr>
                                <?php $magang = $magang->magang ?>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$magang->divisi->location_magang->nama_lokasi}}</td>
                                <td>{{$magang->divisi->nama_divisi}}</td>
                                <td>
                                    {{$magang->tanggal_mulai}}
                                </td>
                                <td>
                                    {{$magang->tanggal_selesai}}
                                </td>
                                <td>
                                    {{$magang->jangka_waktu}}
                                </td>
                                <td>
                                    @if($magang->status_pengajuan == 'diterima')
                                        <h3><span class="badge badge-success">{{$magang->status_pengajuan}}</span></h3>
                                    @elseif($magang->status_pengajuan == 'proses')
                                        <h3><span class="badge badge-primary">{{$magang->status_pengajuan}}</span></h3>
                                    @else
                                        <h3><span class="badge badge-alert">{{$magang->status_pengajuan}}</span></h3>
                                    @endif
                                </td>
                                <td>
                                    <p>
                                    @foreach($magang->users->pluck('full_name') as $name)
                                        <span class="badge badge-info">{{$name}}</span>
                                    @endforeach
                                    </p>
                                </td>
                                <td>
                                    <a href="{{route('home.file.proposal',['id_magang' => $magang->id])}}" target="_blank" class="btn btn-info btn-sm btn-block">proposal</a>
                                    <a href="{{route('home.file.sp',['id_magang' => $magang->id])}}" target="_blank" class="btn btn-success btn-sm btn-block">surat permohonan</a>
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
