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
                                        <button type="button" class="btn btn-alt-info btn-sm" data-toggle="modal" data-target="#modal-block-edit">Edit</button>
                                        <button type="button" class="btn btn-alt-danger btn-sm" data-toggle="modal" data-target="#modal-block-delete">Hapus</button>
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
                                    <label for="block-form1-username">Nama Lokasi</label>
                                    <input type="text" class="form-control form-control-alt" name="nama_lokasi" required>
                                </div>
                                <div class="form-group">
                                    <label for="block-form1-username">Alamat</label>
                                    <input type="text" class="form-control form-control-alt" name="alamat" required>
                                </div>
                                <div class="form-group">
                                    <label for="block-form1-username">Latitude</label>
                                    <input type="dou" class="form-control form-control-alt" step="any" name="latitude">
                                </div>                                
                                <div class="form-group">
                                    <label for="block-form1-username">Longitude</label>
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

<!-- END Page Content -->
@endsection