@extends('layouts.simple')

@section('content')
<div class="row justify-content-center">

    <div class="col-md-8">
        <div class="content">
            <div class="bg-image" style="background-image: url({{asset('media/photos/background-pln.jpg')}});">
                <div class="bg-primary-dark-op">
                    <div class="content content-full text-center py-6">
                        <h1 class="h2 text-white mb-2">Sistem Pengajuan Magang UPT PLN Pasuruan</h1>
                        <h2 class="h4 font-w400 text-white-75 mb-0">Pendaftaran Akun Magang</h2>
                    </div>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-content block-content-full">
                    <form action="be_forms_elements.html" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                        <div class="row push d-flex justify-content-center">
                            @if ($errors->any())
                                <span class="alert alert-warning col-md-12">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </span>
                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="full_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input">Nomor Induk</label>
                                    <input type="number" class="form-control" name="no_induk" required>
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input">Jurusan / Program Studi</label>
                                    <input type="text" class="form-control" name="jurusan" required>
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input">Sekolah / Kampus</label>
                                    <input type="text" class="form-control" name="sekolah" required>
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input">Jenis Kelamin</label>
                                    <select class="form-control" id="example-select" name="gender">
                                        <option value="1" selected>laki-laki</option>
                                        <option value="0">perempuan</option>                                    
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="example-email-input">Email</label>
                                    <input type="email" class="form-control" id="example-email-input" name="example-email-input" required>
                                </div>
                                <div class="form-group">
                                    <label for="example-password-input">Kata Sandi</label>
                                    <input type="password" class="form-control" id="password-input" name="example-password-input" required>
                                </div>
                                <div class="form-group">
                                    <label for="example-password-input">Konfirmasi Kata Sandi</label>
                                    <input type="password" class="form-control" id="password-conf" name="example-password-input" required>
                                </div>
                                <a class="btn btn-success text-white">Sudah Punya Akun ?</a>
                                <button type="submit" class="btn btn-primary float-right">Daftar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- END Hero -->
@endsection