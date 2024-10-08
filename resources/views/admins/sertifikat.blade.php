@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Surat Keterangan</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">App</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('admin.index')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="#">Surat Keterangan</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

@if ($errors->any())
    <div class="alert alert-warning">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </div>
@endif
@if (session('status'))
<div class="alert alert-warning">
    {{ session('status') }}
</div>
@endif

<!-- Page Content -->
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Daftar peserta magang sudah selesai namun <strong>belum mendapat surat keterangan</strong></h3>
                </div>
                <div class="block-content">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Koordinator</th>
                                <th>Jurusan</th>
                                <th>Sekolah</th>
                                <th>Tanggal Mulai</th>
                                <th>Durasi</th>
                                <th>Tanggal Selesai</th>                                
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($magangs as $magang)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$magang->leader->full_name}}</td>
                                <td>{{$magang->leader->jurusan}}</td>
                                <td>{{$magang->leader->sekolah}}</td>
                                <td>
                                    {{$magang->tanggal_mulai}}
                                </td>
                                <td>
                                    {{$magang->jangka_waktu}}
                                </td>
                                <td>
                                    {{$magang->tanggal_selesai}}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-modal-respon btn-sm" data-id="{{$magang->id}}"
                                     data-divisi="{{$magang->divisi->nama_divisi}}" data-lokasi="{{$magang->divisi->location_magang->nama_lokasi}}"
                                     data-groups="{{$magang->users->pluck('full_name')}}"
                                      data-nama="{{$magang->leader->full_name}}">respon surat keterangan</button>
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

{{-- SERTIFIKAT MAGANG --}}
<!-- Page Content -->
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Daftar peserta mendapatkan surat keterangan</h3>
                </div>
                <div class="block-content">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Koordinator</th>
                                <th>Lokasi</th>
                                <th>Divisi</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Nomor surat keterangan</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sertifikats as $sertifikat)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$sertifikat->magang->leader->full_name}}</td>
                                <td>{{$sertifikat->magang->divisi->location_magang->nama_lokasi}}</td>
                                <td>{{$sertifikat->magang->divisi->nama_divisi}}</td>
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
                                    <a href="{{route('sertifikat-magang.file',['id' => $sertifikat->id])}}"
                                    target="_blank" class="btn btn-block btn-info btn-sm">sertifikat</a>
                                    <button type="button" class="btn modal-status-btn btn-warning btn-block btn-sm"
                                    data-nomor=" {{$sertifikat->surat_terbit->nomor_surat}}" data-tanggal="{{$sertifikat->surat_terbit->tanggal_terbit}}"
                                     data-id="{{$sertifikat->id}}" data-nama="{{$sertifikat->magang->leader->full_name}}">edit</button>
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


<div class="modal fade" id="modal-respon" tabindex="-1" role="dialog" aria-labelledby="modal-respon" aria-hidden="true">
<div class="modal-dialog modal-dialog-slideup" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Upload Pelaksanaan Peserta</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('sertifikat-magang.submit')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block-content font-size-sm">
                    <p>Upload dokumen pelaksaanaan magang peserta </p>
                    <div class="row justify-content-center py-md-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="hidden" name="magang_id" id="pelaksanaan-id">
                                <input type="text" class="form-control form-control-alt" id="pelaksanaan-lokasi" disabled>
                            </div>
                            <div class="form-group">
                                <label>Divisi</label>
                                <input type="text" class="form-control form-control-alt" id="pelaksanaan-divisi" disabled>
                            </div>
                            <div class="form-group">
                                <label>Koordinator</label>
                                <input type="text" class="form-control form-control-alt" id="pelaksanaan-nama" disabled>
                            </div>
                            <div class="form-group">
                                <label>Pelaksana</label>
                                <input type="text" class="form-control form-control-alt" id="pelaksanaan-groups" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nomor Sertifikat</label>
                                <input type="text" class="form-control form-control-alt" name="nomor_surat" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Terbit</label>
                                <input type="date" class="form-control form-control-alt" name="tanggal_terbit" required>
                            </div>
                            <div class="form-group">
                                <label>Dokumen Sertifikat</label>
                                <input type="file" name="file_sertifikat" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="submit" class="btn btn-block btn-primary btn-sm">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="modal-status" tabindex="-1" role="dialog" aria-labelledby="modal-status" aria-hidden="true">
<div class="modal-dialog modal-dialog-slideup" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Pelaksanaan Peserta</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('sertifikat-magang.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block-content font-size-sm">
                    <p class="font-weight-bold">Edit surat keterangan magang</p>
                    <div class="row justify-content-center py-md-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Nama Koordinator</label>
                                <input type="hidden" name="id" id="sertifikat-id">
                                <input type="text" class="form-control form-control-alt" id="sertifikat-nama" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nomor Surat Pelaksanaan</label>
                                <input type="text" class="form-control form-control-alt" id="status-nomor-surat" name="nomor_surat" required>
                            </div>                          
                            <div class="form-group">
                                <label >Tanggal Terbit</label>
                                <input type="date" class="form-control form-control-alt" name="tanggal_terbit" id="status-tanggal" required>
                            </div>
                            <div class="form-group">
                                <label >Update dokumen surat keterangan</label>
                                <input type="file" name="file_sertifikat">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="submit" class="btn btn-block btn-primary btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@section('js_after')
<script>
     $('.btn-modal-respon').on('click', function() {
        $('#pelaksanaan-id').val($(this).data('id'));
        $('#pelaksanaan-nama').val($(this).data('nama'));
        $('#pelaksanaan-lokasi').val($(this).data('lokasi'));
        $('#pelaksanaan-divisi').val($(this).data('divisi'));
        let groups = ''
        $(this).data('groups').map(function(e){
            if(groups != ''){
                groups += ', ' + e;
            }
            else{
                groups += e;
            }
        });
        $('#pelaksanaan-groups').val(groups);

        $('#modal-respon').modal('show');
    });

    $('.modal-status-btn').on('click', function() {
        $('#sertifikat-id').val($(this).data('id'));
        $('#sertifikat-nama').val($(this).data('nama'));
        $('#status-nomor-surat').val($(this).data('nomor'))
        $('#status-tanggal').val($(this).data('tanggal'))
        $('#modal-status').modal('show');
    });
</script>
@endsection