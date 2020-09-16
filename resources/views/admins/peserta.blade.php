@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">List Akun Magang</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">App</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('admin.index')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="#">List Akun Magang</a>
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
                    <h3 class="block-title">Daftar Akun Peserta Magang</h3>
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
                                <th>#</th>
                                <th>No Induk</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Sekolah</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesertas as $peserta)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$peserta->no_induk}}</td>
                                <td>{{$peserta->full_name}}</td>
                                <td>{{$peserta->jurusan}}</td>
                                <td>{{$peserta->sekolah}}</td>
                                <td>{{$peserta->gender == 1? 'laki-laki' : 'perempuan'}}</td>
                                <td>{{$peserta->email}}</td>
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