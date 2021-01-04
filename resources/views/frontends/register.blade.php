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
                    <div class="row push d-flex justify-content-center">
                        @if ($errors->any())
                        <span class="alert alert-warning col-md-12">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </span>
                        @endif
                        @if (session('status'))
                        <div class="alert alert-success col-md-12"">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="col-md-12">
                            <form action="{{route('register')}}" method="POST" class="validatedForm" >
                                @csrf
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" name="full_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Induk Siswa / Mahasiswa</label>
                                    <input type="number" class="form-control" name="no_induk" required>
                                </div>
                                <div class="form-group">
                                    <label>Jurusan / Program Studi</label>
                                    <input type="text" class="form-control" name="jurusan" required>
                                </div>
                                <div class="form-group">
                                    <label>Sekolah / Kampus</label>
                                    <input type="text" class="form-control" name="sekolah" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control" id="example-select" name="gender">
                                        <option value="1" selected>laki-laki</option>
                                        <option value="0">perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="example-email-input">Email</label>
                                    <input type="email" class="form-control" id="example-email-input" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label >Kata Sandi</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label >Konfirmasi Kata Sandi</label>
                                    <input type="password" class="form-control" id="password_confirm" required>
                                </div>
                                <button type="submit" id="submit-btn" class="btn btn-primary float-right">Daftar</button>
                            </form>
                            <a href="{{route('login.form')}}" type="button" class="btn btn-success text-white">Sudah Punya Akun ?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END Hero -->
@endsection


@section('js_after')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    $('#submit-btn').click(function(){
        jQuery('.validatedForm').validate({
        rules: {
            password: {
                minlength: 5
            },
            password_confirm: {
                minlength: 5,
                equalTo: "#password"
            }
        }
    })
    })
</script>

@endsection