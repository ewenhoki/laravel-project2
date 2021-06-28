@extends('layouts.master')

@section('header')
    <link href="{{asset('datetime/jquery.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/extra-libs/prism/prism.css')}}" rel="stylesheet">
    <title>Kolokium</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Kolokium</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/student/dashboard/student_profile" class="breadcrumb">Dashboard</a>
                <a href="/student/dashboard/colloquium" class="breadcrumb">Kolokium</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @if(auth()->user()->student->lecturers()->wherePivot('order',1)->first() && auth()->user()->student->lecturers()->wherePivot('order',2)->first())
            @if(auth()->user()->student->lecturers()->wherePivot('order',1)->first()->attendances()->count() < 10 && auth()->user()->student->lecturers()->wherePivot('order',2)->first()->attendances()->count() < 10)
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Anda Belum Menyelesaikan Bimbingan</h3>
                        <p>Pengajuan kolokium dibuka setelah melakukan minimal 10 bimbingan untuk pembimbing 1 dan pembimbing 2.</p>
                        <a href="/student/dashboard/attendance" class="waves-effect waves-light btn indigo">Buat Bimbingan</a>
                    </div>
                </div>
            </div>
            @else
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Pengajuan Kolokium</h3>
                        @if(auth()->user()->student->colloquium)
                        <p>Anda Telah Mengajukan Kolokium. Silakan upload dokumen pada form disamping.</p>
                        <table style="width: 100%">
                            <tr>
                                <td>Nama</td>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <td>NPM</td>
                                <td>{{ auth()->user()->student->npm }}</td>
                            </tr>
                            <tr>
                                <td>Pembimbing 1</td>
                                <td>{{ auth()->user()->student->lecturers()->wherePivot('order',1)->first()->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Pembimbing 2</td>
                                <td>{{ auth()->user()->student->lecturers()->wherePivot('order',2)->first()->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>{{ auth()->user()->student->colloquium->date_time }}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%">Catatan</td>
                                @if(auth()->user()->student->colloquium->note==NULL)
                                <td style="width: 70%">-</td>
                                @else
                                <td style="width: 70%">{{ auth()->user()->student->colloquium->note }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if(auth()->user()->student->colloquium->confirm==0)
                                    <span class="label label-warning">Menunggu Persetujuan Kaprodi</span>
                                    @else
                                    <span class="label label-info">Pengajuan Disetujui</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        @else
                        <p>Silakan lengkapi form dibawah ini. Perhatikan bahwa waktu yang diajukan dapat diubah oleh kepala program studi tergantung pada jadwal yang tersedia.</p>
                        <p>Setelah megisi form, silakan upload dokumen yang diperlukan.</p>
                        <div class="divider"></div><br>
                        {!! Form::open(['url' => '/student/addColloquium','class'=>'formValidate1','id'=>'formValidate1']) !!}
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">access_time</i>
                                {!! Form::text('date_time', '', ['id'=>'time','autocomplete'=>'off']) !!}
                                <label for="time">Waktu</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">speaker_notes</i>
                                {!! Form::textarea('note', '', ['id'=>'note','class'=>'materialize-textarea','data-length'=>255]) !!}
                                <label for="note">Catatan</label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="form-action right-align">
                            <br>
                            <button class="btn cyan waves-effect waves-light submit" type="submit" name="action">Kirim</button>
                        </div>
                        {!! Form::close() !!}   
                        @endif
                    </div>
                </div>
                @if(auth()->user()->student->colloquium)
                @if(auth()->user()->student->colloquium->colloquiumlecturers()->first())
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Dosen Penguji</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Dosen</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(auth()->user()->student->colloquium->colloquiumlecturers()->get() as $key => $colloquiumlecturer)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $colloquiumlecturer->lecturer->user->name }}</td>
                                    <td>
                                        @if($colloquiumlecturer->confirm==0)
                                        <span class="label label-warning">Menunggu Konfirmasi</span>
                                        @else
                                        <span class="label label-info">Dikonfirmasi</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                @endif
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Dokumen Kolokium</h3>
                        @if(auth()->user()->student->colloquium)
                            @if(auth()->user()->student->colloquium->colloquiumfiles()->count()!=0)
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Upload</th>
                                        <th>Nama File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($colloquiumfile as $key => $file)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $file->created_at }}</td>
                                        <td>
                                            @php
                                                $file->file;
                                                $count = strlen($file->file)-1;
                                                $buffer = '';
                                                for($i=$count; $i>0; $i--){
                                                    if($file->file[$i]=="/"){
                                                        break;
                                                    }
                                                    else{
                                                        $buffer = $file->file[$i].$buffer;
                                                    }
                                                }
                                            @endphp
                                            {{ $buffer }}
                                        </td>
                                        <td>
                                            <a href="{{ $file->file }}" class="waves-effect waves-light btn deep-purple darken-3" target="_blank">Download</a>
                                            <a href="javascript:void(0);" class="waves-effect waves-light btn red deletereq1" file-id="{{ $file->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p>Anda belum melakukan upload dokumen.</p>
                            @endif
                            {!! Form::open(['url' => '/colloquium/document/upload','class'=>'formValidate','id'=>'formValidate']) !!}       
                                <div class="file-field input-field">
                                    <div>
                                        <a class="btn blue darken-1" id="fm-1" data-input="file" data-preview="holder">Tambah Dokumen</a>
                                    </div>
                                    <div class="file-path-wrapper">
                                        {!! Form::text('file','', ['placeholder'=>'Dokumen','id'=>'file','class'=>'form-control','readonly']) !!}
                                    </div>
                                </div>   
                                <div class="form-action right-align">
                                    <button class="btn cyan waves-effect waves-light submit" type="submit" name="action">Kirim</button>
                                </div>              
                            {!! Form::close() !!}
                        @else
                        <p>Anda belum melakukan pengajuan kolokium, silakan lakukan pengajuan kolokium kemudian upload dokumen yang diperlukan</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @else
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Anda Belum Menyelesaikan Bimbingan</h3>
                        <p>Pengajuan kolokium dibuka setelah melakukan minimal 10 bimbingan untuk pembimbing 1 dan pembimbing 2.</p>
                        <a href="/student/dashboard/attendance" class="waves-effect waves-light btn indigo">Buat Bimbingan</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="{{asset('datetime/jquery.datetimepicker.full.js')}}"></script>
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script src="{{asset('admin/assets/extra-libs/prism/prism.js')}}"></script>
    <script src="{{asset('admin/dist/js/pages/forms/jquery.validate.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today =  yyyy + '-' + mm + '-' + dd;
        jQuery.datetimepicker.setLocale('id')
        $('#time').datetimepicker({
            timepicker: true,
            datepicker: true,
            format: 'Y-m-d H:i',
            hours12: false,
            defaultDate: today,
            step: 15,
            lang: 'id',
        });
    });
    $(function() {
        $(".formValidate1").validate({
            rules: {
                note: {
                    maxlength: 255,
                },
                date_time: {
                    required: true,
                },
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            },
            invalidHandler: function(e, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    $('.error-alert-bar').show();
                }
            },
        });
    });
    $('#fm-1').filemanager('file');
    $('.deletereq1').click(function(){
            var file_id = $(this).attr('file-id');
            swal({   
                title: "Yakin ?",   
                text: "Dokumen tidak dapat dilihat ketika sudah dihapus.",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Ya",   
                cancelButtonText: "Tidak",   
                closeOnConfirm: false,   
                closeOnCancel: false 
            })
            .then(function(WillDelete){
                if(WillDelete.value){
                    window.location = "/colloquium/document/delete/"+file_id;
                }
            });
        });
    </script>
    @if (session('request'))
    <script>
        toastr.success('Pengajuan Kolokium Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
    @if (session('uploaded'))
    <script>
        toastr.success('Tambah Dokumen Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
    @if (session('deleted'))
    <script>
        toastr.success('Hapus Dokumen Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
@endsection