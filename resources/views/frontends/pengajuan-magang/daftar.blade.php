@extends('layouts.frontend')

@section('css_after')
<link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{asset('js/plugins/select2/css/select2.min.css')}}">
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Pengajuan Magang</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">App</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('index')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('pengajuan-magang.index')}}">Pengajuan Magang</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="#">Pendaftaran Magang</a>
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
                        <div class="content content-full text-white text-center py-6">
                            {{$location->nama_lokasi}}
                        </div>
                    </div>
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
                    <h3 class="block-title">Isi Berkas Pengajuan Magang</h3>
                </div>
                <div class="block-content">
                    @if (session('status'))
                    <div class="alert alert-warning">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{route('pengajuan-magang.submit')}}" method="POST" class="validatedForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="d-block">File Surat Permohonan Magang</label>
                            <input type="file" name="surat_pemohon">
                        </div>
                        <div class="form-group">
                            <label class="d-block">File Proposal</label>
                            <input type="file" name="proposal">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Divisi</label>
                            <select class="form-control" id="divisi_id" name="divisi_id">
                                @foreach($divisis as $d)
                                <option value="{{$d->id}}">{{$d->nama_divisi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Anggota</label>
                            <select class="js-select2 form-control" id="example-select2-multiple"
                             name="groups[]" style="width: 100%;" multiple="multiple">
                                <option></option>
                                @foreach($users as $u)
                                    <option value="{{$u->id}}">{{$u->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Rentang Tanggal Magang</label>
                            <input type="hidden" class="form-control" name="location_magang_id" value="{{$location->id}}">
                            <input type="hidden" class="form-control" name="tanggal_mulai" id="tanggal_mulai">
                            <input type="hidden" class="form-control" name="tanggal_selesai" id="tanggal_selesai">
                            <input type="text" class="js-flatpickr form-control bg-white" id="example-flatpickr-range" name="example-flatpickr-range" placeholder="Rentang Tanggal Magang" data-mode="range" data-min-date="today">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox mb-1">
                                <input type="checkbox" id="example-checkbox-custom1" class="custom-control-input" required>
                                <label class="custom-control-label" for="example-checkbox-custom1">Data ini setelah di ajukan tidak bisa dirubah, Dengan ini semua persyaratan pengajuan sudah dipenuhi</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submit-btn" class="btn btn-primary float-right">Ajukan</button>
                        </div>
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
<script src="{{asset('js/plugins/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('js/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    let firstDate;
    let toDisable;
    let seletectedDivisi = $('#divisi_id').find(":selected").val();

    let configFlatPick = {
        minDate: "today",
        disable: [],
        onChange: function(selectedDates, dateStr, instance) {
            if (instance.selectedDates.length >= 1) {
                firstDate = flatpickr.formatDate(instance.selectedDates[0], "Y/m/d");
                lastDate = flatpickr.formatDate(instance.selectedDates[1], "Y/m/d");
                $('#tanggal_mulai').val(firstDate);
                $('#tanggal_selesai').val(lastDate);
                let divisi = $("#divisi_id" ).val();
                let baseDivisiUrl = '{{url("/pengajuan-magang/divisi/")}}' + divisi;
                return;
            }
            firstDate = null;
        },
    };

    $('#example-select2-multiple').select2({
        theme: "classic"
    });

    // const flatpickr = $("#example-flatpickr-range").flatpickr(configFlatPick);

    // var date = new Date();
    // var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    // var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

    
    // $( "#divisi_id" ).change(function() {
       // $(this).val();
        // seletectedDivisi = 
    // });
</script>
@endsection