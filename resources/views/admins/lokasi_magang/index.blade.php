@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Lokasi Magang</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">App</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('admin.index')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="#">Lokasi Magang</a>
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
                    <h3 class="block-title">Daftar Lokasi Magang</h3>
                    <button type="button" class="btn btn-alt-primary push" data-toggle="modal" data-target="#modal-block-slideup">Tambah Lokasi</button>
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
                                <th>Jumlah Bagian</th>
                                <th style="width: 20%;">Aksi</th>
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
                                <td class="d-none d-sm-table-cell">
                                    {{$lokasi->divisis->count()}}
                                </td>
                                <td>
                                    <button type="button" data-id="{{$lokasi->id}}" data-alamat="{{$lokasi->alamat}}" data-latitude="{{$lokasi->latitude}}" data-longitude="{{$lokasi->longitude}}" data-nama="{{$lokasi->nama_lokasi}}" class="modal-edit-btn btn btn-alt-info btn-sm">Edit</button>
                                    <button type="button" class="btn modal-delete-btn btn-alt-danger btn-sm" data-id="{{$lokasi->id}}" data-nama="{{$lokasi->nama_lokasi}}">Hapus</button>
                                    <a href="{{route('divisi.index',['id'=>$lokasi->id])}}" class="btn btn-alt-primary btn-sm" {{$lokasi->nama_lokasi}}">Bagian</a>
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

<div class="modal fade" id="modal-block-slideup" tabindex="-1" role="dialog" aria-labelledby="modal-block-slideup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideup" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Lokasi Magang</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('lokasi-magang.tambah')}}" method="POST">
                    @csrf
                    <div class="block-content font-size-sm">
                        <div class="row justify-content-center py-md-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Nama Lokasi</label>
                                    <input type="text" class="form-control form-control-alt" name="nama_lokasi" required>
                                </div>
                                <div class="form-group">
                                    <label >Alamat</label>
                                    <input type="text" class="form-control form-control-alt" name="alamat" required>
                                </div>
                                <div class="form-group">
                                    <label >Latitude</label>
                                    <input type="number" class="form-control form-control-alt" step="any" name="latitude">
                                </div>
                                <div class="form-group">
                                    <label >Longitude</label>
                                    <input type="number" class="form-control form-control-alt" step="any" name="longitude">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-block-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideup" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Edit Lokasi Magang</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('lokasi-magang.edit')}}" method="POST">
                    @csrf
                    <div class="block-content font-size-sm">
                        <div class="row justify-content-center py-md-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Nama Lokasi</label>
                                    <input type="hidden" name="id" id="edit-id">
                                    <input type="text" class="form-control form-control-alt" name="nama_lokasi" id="edit-nama" required>
                                </div>
                                <div class="form-group">
                                    <label >Alamat</label>
                                    <input type="text" class="form-control form-control-alt" name="alamat" id="edit-alamat" required>
                                </div>
                                <div class="form-group">
                                    <label >Latitude</label>
                                    <input type="number" class="form-control form-control-alt" step="any" id="edit-latitude" name="latitude">
                                </div>
                                <div class="form-group">
                                    <label >Longitude</label>
                                    <input type="number" class="form-control form-control-alt" step="any" id="edit-longitude" name="longitude">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-block-delete" tabindex="-1" role="dialog" aria-labelledby="modal-block-delete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideup" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Hapus Lokasi Magang</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('lokasi-magang.delete')}}" method="POST">
                    @csrf
                    <div class="block-content font-size-sm">
                        <p>Apakah anda yakin ingin menghapus lokasi berikut ? </p>
                        <div class="row justify-content-center py-md-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Nama Lokasi</label>
                                    <input type="hidden" name="id" id="delete-id">
                                    <input type="text" class="form-control form-control-alt" id="delete-nama">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection

@section('js_after')
<script type="text/javascript">

    $('.modal-edit-btn').on('click', function() {
        $('#edit-id').val($(this).data('id'));
        $('#edit-alamat').val($(this).data('alamat'));
        $('#edit-nama').val($(this).data('nama'));
        $('#edit-latitude').val($(this).data('latitude'));
        $('#edit-longitude').val($(this).data('longitude'));
        $('#modal-block-edit').modal('show');
    });

    $('.modal-delete-btn').on('click', function() {
        $('#delete-id').val($(this).data('id'));
        $('#delete-nama').val($(this).data('nama'));
        $('#modal-block-delete').modal('show');
    });
</script>
<script>

</script>
@endsection