@extends('layouts.frontend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Pengajuan Magang</h1>
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

<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="block">
                <div class="bg-image" style="background-image: url({{asset('media/photos/background-pln.jpg')}});">
                    <div class="bg-primary-dark-op">
                        <div class="content content-full text-white text-center py-6">
                            {{$location->nama_lokasi}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Isi Berkas Pengajuan Magang</h3>
                </div>
                <div class="block-content">
                    @if (session('status'))
                    <div class="alert alert-warning">
                        {{ session('status') }}
                    </div>
                    @endif
                        <form action="{{route('pengajuan-magang.submit')}}" method="POST" class="validatedForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tanggal Mulai Magang</label>
                                <input type="hidden" class="form-control" name="location_magang_id" value="{{$location->id}}">
                                <input type="date" class="form-control" name="tanggal_mulai" required>
                            </div>
                            <div class="form-group">
                                <label>Durasi Magang (Hari)</label>
                                <input type="number" min="30" class="form-control" name="jangka_waktu" required>
                            </div>
                            <div class="form-group">
                                <label class="d-block">File Surat Permohonan Magang</label>
                                <input type="file" name="surat_pemohon">
                            </div>
                            <div class="form-group">
                                <label class="d-block">File Proposal</label>
                                <input type="file" name="proposal">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" id="example-checkbox-custom1" class="custom-control-input" required>
                                    <label class="custom-control-label" for="example-checkbox-custom1">Dengan ini semua persyaratan pengajuan sudah dipenuhi</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="submit-btn" class="btn btn-primary float-right">Ajukan</button>
                            </div>
                            <br>
                            <br>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js_after')

@endsection