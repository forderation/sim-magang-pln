@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Profil</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">App</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('admin.index')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="#">Akun Profil</a>
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
                        <div class="content content-full text-center py-6">
                            <h2 class="text-white">Akun Profil</h2> <h3 class="text-white">Sistem Pengajuan Magang PLN</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session('status'))
<div class="alert alert-warning">
    {{ session('status') }}
</div>
@endif
@if ($errors->any())
<span class="alert alert-danger col-md-12">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</span>
@endif

<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Profile Saya</h3>
                </div>
                <div class="block-content">
                    <form action="{{route('admin.profil.update')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="full_name" value="{{$user->full_name}}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}" required>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Perbarui Profil</button>
                        <br>
                        <br>
                    </form>
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
                    <h3 class="block-title">Update Kata Sandi</h3>
                </div>
                <div class="block-content">
                    <form action="{{route('admin.password.update')}}" method="POST" class="validatedForm">
                        @csrf
                        <div class="form-group">
                            <label>Kata Sandi Lama</label>
                            <input type="password" class="form-control" name="old_password" required>
                        </div>
                        <div class="form-group">
                            <label>Kata Sandi Baru</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Kata Sandi Baru</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                        </div>
                        <button type="submit" id="submit-btn" class="btn btn-primary float-right">Perbarui Kata Sandi</button>
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