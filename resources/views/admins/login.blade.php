@extends('layouts.simple')

@section('content')
<div class="row justify-content-center">

    <div class="col-md-8">
        <div class="content">
            <div class="bg-image" style="background-image: url({{asset('media/photos/background-pln.jpg')}});">
                <div class="bg-primary-dark-op">
                    <div class="content content-full text-center py-6">
                        <h1 class="h2 text-white mb-2">Sistem Pengajuan Magang PLN Pasuruan</h1>
                        <h2 class="h4 font-w400 text-white-75 mb-0">Login Admin</h2>
                    </div>
                </div>
            </div>
            <div class="block block-rounded text-white bg-dark">
                <div class="block-content block-content-full">
                    <form action="{{route('admin.login')}}" method="POST" class="validatedForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row push d-flex justify-content-center">
                            <div class="col-md-8">
                                @if (session('status'))
                                <div class="alert alert-danger">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="example-email-input">Email</label>
                                    <input type="email" class="form-control" id="example-email-input" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="example-password-input">Kata Sandi</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="example-checkbox-custom1" name="remember">
                                    <label class="custom-control-label" for="example-checkbox-custom1">Ingat saya</label>
                                </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Masuk</button>
                            </div>
                        </div>
                    </form>
                </div>                
                <div class="content content-full font-size-sm text-muted text-center">
                    <strong>Template by OneUI</strong> &copy; <span data-toggle="year-copy"></span>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- END Hero -->
@endsection


@section('js_after')

@endsection