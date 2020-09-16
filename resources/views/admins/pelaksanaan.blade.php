@extends('layouts.backend')

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
                        <a class="link-fx" href="{{route('admin.index')}}">Dashboard</a>
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
                    <h3 class="block-title">Daftar peserta magang diterima namun <strong>belum mendapat surat pelaksaanaan</strong></h3>
                </div>
                <div class="block-content">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Sekolah</th>
                                <th>Lokasi</th>
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
                                <td>{{$magang->user->full_name}}</td>
                                <td>{{$magang->user->jurusan}}</td>
                                <td>{{$magang->user->sekolah}}</td>
                                <td>{{$magang->location_magang->nama_lokasi}}</td>
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
                                    <button type="button" class="btn btn-warning btn-modal-respon btn-sm" data-id="{{$magang->id}}" data-lokasi="{{$magang->location_magang->nama_lokasi}}" data-nama="{{$magang->user->full_name}}">respon pelaksanaan</button>
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


<!-- Page Content -->
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Daftar peserta pelaksanaan magang</h3>
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
                                <th>Nomor Surat</th>
                                <th>Status Pelaksanaan</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelaksanaans as $pelaksanaan)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$pelaksanaan->magang->user->full_name}}</td>
                                <td>{{$pelaksanaan->magang->user->sekolah}}</td>
                                <td>{{$pelaksanaan->magang->location_magang->nama_lokasi}}</td>
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
                                    <h3><span class="badge {{$pelaksanaan->status_magang == 'aktif'? 'badge-success':'badge-warning'}}">{{$pelaksanaan->status_magang}}</span></h3>
                                </td>
                                <td>
                                    <a href="{{route('pelaksanaan-magang.file',['id' => $pelaksanaan->id])}}" target="_blank" class="btn btn-block btn-info btn-sm">surat</a>
                                    <button type="button" class="btn modal-status-btn btn-warning btn-block btn-sm" data-status="{{$pelaksanaan->status_magang}}"
                                        data-nomor=" {{$pelaksanaan->surat_terbit->nomor_surat}}" data-tanggal="{{$pelaksanaan->surat_terbit->tanggal_terbit}}"
                                     data-id="{{$pelaksanaan->id}}" data-nama="{{$pelaksanaan->magang->user->full_name}}">edit</button>
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
            <form action="{{route('pelaksanaan-magang.submit')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block-content font-size-sm">
                    <p>Upload dokumen pelaksaanaan magang peserta </p>
                    <div class="row justify-content-center py-md-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Nama Lokasi</label>
                                <input type="hidden" name="magang_id" id="pelaksanaan-id">
                                <input type="text" class="form-control form-control-alt" id="pelaksanaan-lokasi" disabled>
                            </div>
                            <div class="form-group">
                                <label >Nama Peserta</label>
                                <input type="text" class="form-control form-control-alt" id="pelaksanaan-nama" disabled>
                            </div>
                            <div class="form-group">
                                <label >Nomor Surat Terbit Pelaksanaan</label>
                                <input type="text" class="form-control form-control-alt" name="nomor_surat" required>
                            </div>
                            <div class="form-group">
                                <label >Tanggal Terbit</label>
                                <input type="date" class="form-control form-control-alt" name="tanggal_terbit" required>
                            </div>
                            <div class="form-group">
                                <label>Status Magang</label>
                                <select class="form-control" name="status_magang">
                                    <option value="aktif" selected>aktif</option>
                                    <option value="non_aktif">non-aktif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Dokumen Surat Terbit Pelaksanaan</label>
                                <input type="file" name="file_surat" required>
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
            <form action="{{route('status-magang.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block-content font-size-sm">
                    <p>Edit status pelaksanaan </p>
                    <div class="row justify-content-center py-md-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Nama Peserta</label>
                                <input type="hidden" name="id" id="status-pelaksanaan-id">
                                <input type="text" class="form-control form-control-alt" id="status-pelaksanaan-nama" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nomor Surat Pelaksanaan</label>
                                <input type="text" class="form-control form-control-alt" id="status-nomor-surat" name="nomor_surat" required>
                            </div>
                            <div class="form-group">
                                <label>Status Magang</label>
                                <select class="form-control" name="status_magang" id="status-pelaksanaan">
                                    <option value="aktif">aktif</option>
                                    <option value="non_aktif">non-aktif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Tanggal Terbit</label>
                                <input type="date" class="form-control form-control-alt" name="tanggal_terbit" id="status-tanggal" required>
                            </div>
                            <div class="form-group">
                                <label >Update Dokumen Surat Terbit Pelaksanaan</label>
                                <input type="file" name="file_surat">
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
        $('#modal-respon').modal('show');
    });

    $('.modal-status-btn').on('click', function() {
        $('#status-pelaksanaan-id').val($(this).data('id'));
        $('#status-pelaksanaan-nama').val($(this).data('nama'));
        $("#status-pelaksanaan select").val($(this).data('status'));
        $('#status-nomor-surat').val($(this).data('nomor'))
        $('#status-tanggal').val($(this).data('tanggal'))
        $('#modal-status').modal('show');
    });
</script>
@endsection