@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Lokasi bagian {{$lm->nama_lokasi}}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">App</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('admin.index')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('lokasi-magang.index')}}">Lokasi Magang</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="#">Bagian</a>
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
                    <h3 class="block-title">Daftar Bagian</h3>
                    <button type="button" class="btn btn-alt-primary push" data-toggle="modal"
                     data-target="#modal-block-slideup">Tambah Bagian</button>
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
                                <th>Nama Bagian</th>
                                <th>Maksimal Kelompok</th>
                                <th>Jumlah Magang Terdaftar</th>
                                <th style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($divisis as $divisi)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="font-w600">
                                    {{$divisi->nama_divisi}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{$divisi->maksimal_kelompok}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{$divisi->magangs->count()}}
                                </td>
                                <td>
                                    <button type="button" data-id="{{$divisi->id}}" 
                                        data-nama="{{$divisi->nama_divisi}}" 
                                        data-maks="{{$divisi->maksimal_kelompok}}" 
                                        class="modal-edit-btn btn btn-alt-info btn-sm">Edit</button>
                                    <button type="button" class="btn modal-delete-btn btn-alt-danger btn-sm"
                                     data-id="{{$divisi->id}}" data-nama="{{$divisi->nama_divisi}}">Hapus</button>
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
                    <h3 class="block-title">Tambah Bagian Lokasi Magang</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('divisi.tambah')}}" method="POST">
                    @csrf
                    <div class="block-content font-size-sm">
                        <div class="row justify-content-center py-md-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Nama Bagian</label>
                                    <input type="hidden" name="location_magang_id" value="{{$lm->id}}" >
                                    <input type="text" class="form-control form-control-alt" name="nama_divisi" required>
                                </div>
                                <div class="form-group">
                                    <label >Maksimal Kelompok</label>
                                    <input type="number" class="form-control form-control-alt" name="maksimal_kelompok" required>
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
                    <h3 class="block-title">Edit Bagian</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('divisi.edit')}}" method="POST">
                    @csrf
                    <div class="block-content font-size-sm">
                        <div class="row justify-content-center py-md-4">
                            <div class="col-md-12">
                            <div class="form-group">
                            <input type="hidden" name="id" id="edit-id" >
                                    <label >Nama Bagian</label>
                                    <input type="text" class="form-control form-control-alt" name="nama_divisi"
                                    id="edit-nama" required>
                                </div>
                                <div class="form-group">
                                    <label >Maksimal Kelompok</label>
                                    <input type="number" class="form-control form-control-alt" 
                                    id="edit-maks" name="maksimal_kelompok" required>
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
                    <h3 class="block-title">Hapus Bagian Magang</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('divisi.delete')}}" method="POST">
                    @csrf
                    <div class="block-content font-size-sm">
                        <p>Apakah anda yakin ingin menghapus bagian berikut ? </p>
                        <div class="row justify-content-center py-md-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Nama Bagian</label>
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
        $('#edit-nama').val($(this).data('nama'));
        $('#edit-maks').val($(this).data('maks'));
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