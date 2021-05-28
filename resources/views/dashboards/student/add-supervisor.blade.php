@extends('layouts.master')

@section('header')
    <title>Math Unpad - Dosen Pembimbing</title>
    <link href="{{asset('admin/dist/css/pages/form-page.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/extra-libs/prism/prism.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/libs/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Dosen Pembimbing</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/student/dashboard/student_profile" class="breadcrumb">Dashboard</a>
                <a href="/users/add" class="breadcrumb">Dosen Pembimbing</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="row">
                        <div class="col s12 l4">
                            <div class="card-content">
                                <h5 class="card-title">Dosen Pembimbing 1</h5>
                                @if(auth()->user()->student->lecturers()->wherePivot('order',1)->first()==NULL)
                                    <p>Belum Memilih Dosen</p>
                                    <h3 class="card-title">Progress</h3>
                                    <p>Belum Mengajukan Dosen Pembimbing</p>
                                @else
                                    <p>{{ auth()->user()->student->lecturers()->wherePivot('order',1)->first()->first_name.' '.auth()->user()->student->lecturers()->wherePivot('order',1)->first()->last_name }}</p>
                                    <h3 class="card-title">Progress</h3>
                                    <p>{{ $status[auth()->user()->student->lecturers()->wherePivot('order',1)->first()->pivot->progress-1] }}</p>
                                @endif
                                <a href="#" class="red accent-4 btn-large">Hapus Dosen Pembimbing</a>
                            </div>
                        </div>
                        <div class="col s12 l8 b-l">
                            <div class="card-content">
                                <h5 class="card-title">Form Pemilihan Dosen Pembimbing 1</h5>
                                <div class="divider"></div><br>
                                {!! Form::open(['url' => '/postsupervisor/1','class'=>'formValidate','id'=>'formValidate']) !!}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        @if(auth()->user()->student->lecturers()->wherePivot('order',1)->first()==NULL)
                                            {{ Form::select('lecturer_id', $lecturer) }}
                                        @else
                                            {{ Form::select('lecturer_id', $lecturer, auth()->user()->student->lecturers()->wherePivot('order',1)->first()->id) }}
                                        @endif
                                        <label for="lecturer_id">Pilih Dosen Pembimbing 1</label>
                                        <div class="errorTxt1"></div>
                                    </div>
                                </div>
                                <div class="divider"></div>
                                <div class="form-action right-align">
                                    <br>
                                    <button class="btn cyan waves-effect waves-light submit" type="submit" name="action">Submit</button>
                                    <a class="btn waves-effect waves-light grey darken-4" href="/student/dashboard/student_profile" name="action">Cancel
                                    </a>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="row">
                        <div class="col s12 l4">
                            <div class="card-content">
                                <h5 class="card-title">Dosen Pembimbing 2</h5>
                                @if(auth()->user()->student->lecturers()->wherePivot('order',2)->first()==NULL)
                                    <p>Belum Memilih Dosen</p>
                                    <h3 class="card-title">Progress</h3>
                                    <p>Belum Mengajukan Dosen Pembimbing</p>
                                @else
                                    <p>{{ auth()->user()->student->lecturers()->wherePivot('order',2)->first()->first_name.' '.auth()->user()->student->lecturers()->wherePivot('order',1)->first()->last_name }}</p>
                                    <h3 class="card-title">Progress</h3>
                                    <p>{{ $status[auth()->user()->student->lecturers()->wherePivot('order',2)->first()->pivot->progress-1] }}</p>
                                @endif
                                <a href="#" class="red accent-4 btn-large">Hapus Dosen Pembimbing</a>
                            </div>
                        </div>
                        <div class="col s12 l8 b-l">
                            <div class="card-content">
                                <h5 class="card-title">Form Pemilihan Dosen Pembimbing 2</h5>
                                <div class="divider"></div><br>
                                {!! Form::open(['url' => '/postsupervisor/2','class'=>'formValidate','id'=>'formValidate2']) !!}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        @if(auth()->user()->student->lecturers()->wherePivot('order',2)->first()==NULL)
                                            {{ Form::select('lecturer_id', $lecturer) }}
                                        @else
                                            {{ Form::select('lecturer_id', $lecturer, auth()->user()->student->lecturers()->wherePivot('order',2)->first()->id) }}
                                        @endif
                                        <label for="lecturer_id">Pilih Dosen Pembimbing 2</label>
                                        <div class="errorTxt2"></div>
                                    </div>
                                </div>
                                <div class="divider"></div>
                                <div class="form-action right-align">
                                    <br>
                                    <button class="btn cyan waves-effect waves-light submit" type="submit" name="action">Submit</button>
                                    <a class="btn waves-effect waves-light grey darken-4" href="/student/dashboard/student_profile" name="action">Cancel
                                    </a>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="{{asset('admin/assets/libs/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script src="{{asset('admin/assets/extra-libs/prism/prism.js')}}"></script>
    <script src="{{asset('admin/dist/js/pages/forms/jquery.validate.min.js')}}"></script>
    <script>
        $(function() {
            $("#formValidate").validate({
                rules: {
                    lecturer_id: {
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
            $("#formValidate2").validate({
                rules: {
                    lecturer_id: {
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
    </script>
     @if (session('fail'))
        <script>
            swal({   
                title: "Warning",   
                text: "Anda belum memilih dosen !",   
                type: "warning",   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Close",     
                closeOnConfirm: true,   
            });
        </script>
     @endif
     @if (session('exists'))
        <script>
            swal({   
                title: "Warning",   
                text: "Anda sudah memilih dosen !",   
                type: "warning",   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Close",     
                closeOnConfirm: true,   
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            swal({   
                title: "Success",   
                text: "Berhasil memilih dosen !",   
                type: "success",   
            });
        </script>
    @endif
@endsection