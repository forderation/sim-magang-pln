@extends('layouts.backend')

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

@if (session('status'))
<div class="alert alert-warning">
    {{ session('status') }}
</div>
@endif
@if ($errors->any())
<div class="alert alert-warning">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</div>
@endif
    
    <!-- Page Content -->
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Daftar Peserta Proses Mengajukan Magang</h3>
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
                                <th style="width: 25%;">Detail</th>
                                <th style="width: 25%;">Respon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proposals as $magang)
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
                                    <a href="{{route('home.file.proposal',['id_magang' => $magang->id])}}" target="_blank" class="btn btn-block btn-info btn-sm">proposal</a>
                                    <a href="{{route('home.file.sp',['id_magang' => $magang->id])}}" target="_blank" class="btn btn-block btn-primary btn-sm">surat</a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-modal-persetujuan btn-sm" data-id="{{$magang->id}}" data-lokasi="{{$magang->location_magang->nama_lokasi}}" data-nama="{{$magang->user->full_name}}">respon</button>
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
                            @foreach ($pelaksanaans as $magang)
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

<div class="modal fade" id="modal-persetujuan" tabindex="-1" role="dialog" aria-labelledby="modal-persetujuan" aria-hidden="true">
<div class="modal-dialog modal-dialog-slideup" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Persetujuan Peserta</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content font-size-sm">
                <p>Persetujuan proses pengajuan magang </p>
                <div class="row justify-content-center py-md-4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label >Nama Lokasi</label>
                            <input type="text" class="form-control form-control-alt" id="persetujuan-lokasi" disabled>
                        </div>
                        <div class="form-group">
                            <label >Nama Peserta</label>
                            <input type="text" class="form-control form-control-alt" id="persetujuan-nama" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full text-right border-top">
                <a href="" id="btn-stuju" class="btn btn-block btn-success btn-sm">setujui</a>
                <a href="" id="btn-tolak" class="btn btn-block btn-danger btn-sm">tolak</a>
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
@endsection

@section('js_after')
<script>
     $('.btn-modal-respon').on('click', function() {
        $('#pelaksanaan-id').val($(this).data('id'));
        $('#pelaksanaan-nama').val($(this).data('nama'));
        $('#pelaksanaan-lokasi').val($(this).data('lokasi'));
        $('#modal-respon').modal('show');
    });
     $('.btn-modal-persetujuan').on('click', function() {
        $('#persetujuan-nama').val($(this).data('nama'));
        $('#persetujuan-lokasi').val($(this).data('lokasi'));
        $("#btn-stuju").attr("href", $(this).data('id') + "/setuju");
        $("#btn-tolak").attr("href", $(this).data('id') + "/tolak");
        $('#modal-persetujuan').modal('show');
    });
</script>
@endsection