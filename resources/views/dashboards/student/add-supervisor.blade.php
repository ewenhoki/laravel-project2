@extends('layouts.master')

@section('header')
    <title>Math Unpad - Dosen Pembimbing</title>
    <link href="{{asset('admin/dist/css/pages/form-page.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/extra-libs/prism/prism.css')}}" rel="stylesheet">
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
                                <p>Nama Dosen</p>
                                <h3 class="card-title">Progress</h3>
                                <p>Menunggu Persetujuan Kepala Program Studi</p>
                                <a href="#" class="blue accent-4 btn-large">Checkout All Reviews</a>
                            </div>
                        </div>
                        <div class="col s12 l8 b-l">
                            <div class="card-content">
                                <h5 class="card-title">Form Pemilihan Dosen Pembimbing 1</h5>
                                <div class="divider"></div><br>
                                {!! Form::open(['url' => '/proposal/postcreate','class'=>'formValidate','id'=>'formValidate']) !!}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        {{ Form::select('dp-1', $lecturer) }}
                                        {{-- <input id="dp-1" name="dp-1" type="text" data-error=".errorTxt1"> --}}
                                        <label for="dp-1">Pilih Dosen Pembimbing 1</label>
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
                                <h5 class="card-title">Dosen Pembimbing 1</h5>
                                <p>Nama Dosen</p>
                                <h3 class="card-title">Progress</h3>
                                <p>Menunggu Persetujuan Kepala Program Studi</p>
                                <a href="#" class="blue accent-4 btn-large">Checkout All Reviews</a>
                            </div>
                        </div>
                        <div class="col s12 l8 b-l">
                            <div class="card-content">
                                <h5 class="card-title">Form Pemilihan Dosen Pembimbing 1</h5>
                                <div class="divider"></div><br>
                                {!! Form::open(['url' => '/proposal/postcreate','class'=>'formValidate','id'=>'formValidate']) !!}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        {{ Form::select('dp-1', $lecturer) }}
                                        {{-- <input id="dp-1" name="dp-1" type="text" data-error=".errorTxt1"> --}}
                                        <label for="dp-1">Pilih Dosen Pembimbing 1</label>
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
                    {{-- @if ($student->file==NULL)
                    {!! Form::open(['url' => '/proposal/create','class'=>'h-form b-form striped-lables formValidate','id'=>'formValidate']) !!}
                        <div class="form-body">
                            <div class="divider"></div>
                            <div class="card-content">
                                <h6 class="font-medium">Upload Dokumen</h6>
                                <div class="row">
                                    <div class="col s3">
                                        <div class="h-form-label">
                                            <label for="title">Judul</label>
                                        </div>
                                    </div>
                                    <div class="input-field col s9">
                                        {!! Form::text('title','', ['placeholder'=>'Title','id'=>'title']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s3">
                                        <div class="h-form-label">
                                            <label for="krs">KRS</label>
                                        </div>
                                    </div>
                                    <div class="input-field col s9">
                                        <span class="input-group-btn">
                                            <a id="fm-1" data-input="krs" data-preview="holder" class="btn btn-primary">
                                                File Upload
                                            </a>
                                        </span>
                                        {!! Form::text('krs','', ['placeholder'=>'KRS','id'=>'krs','class'=>'form-control','readonly']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s3">
                                        <div class="h-form-label">
                                            <label for="kss">KSS</label>
                                        </div>
                                    </div>
                                    <div class="input-field col s9">
                                        <span class="input-group-btn">
                                            <a id="fm-2" data-input="kss" data-preview="holder" class="btn btn-primary">
                                                File Upload
                                            </a>
                                        </span>
                                        {!! Form::text('kss','', ['placeholder'=>'KSS','id'=>'kss','class'=>'form-control','readonly']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s3">
                                        <div class="h-form-label">
                                            <label for="proposal">Proposal</label>
                                        </div>
                                    </div>
                                    <div class="input-field col s9">
                                        <span class="input-group-btn">
                                            <a id="fm-3" data-input="proposal" data-preview="holder" class="btn btn-primary">
                                                File Upload
                                            </a>
                                        </span>
                                        {!! Form::text('proposal','', ['placeholder'=>'Proposal','id'=>'proposal','class'=>'form-control','readonly']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s3">
                                        <div class="h-form-label">
                                            <label for="paper">Paper</label>
                                        </div>
                                    </div>
                                    <div class="input-field col s9">
                                        <span class="input-group-btn">
                                            <a id="fm-4" data-input="paper" data-preview="holder" class="btn btn-primary">
                                                File Upload
                                            </a>
                                        </span>
                                        {!! Form::text('paper','', ['placeholder'=>'Paper','id'=>'paper','class'=>'form-control','readonly']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                        </div>
                        <div class="divider"></div>
                        <div class="card-content">
                            <div class="form-action">
                                <button class="btn cyan waves-effect waves-light submit" type="submit" name="action">Submit</button>
                                <a class="btn waves-effect waves-light grey darken-4" href="/student/dashboard/student_profile" name="action">Cancel
                                </a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    @else
                    {!! Form::open(['url' => '/proposal/update/'.$student->file->id,'class'=>'h-form b-form striped-lables formValidate','id'=>'formValidate']) !!}
                        <div class="form-body">
                            <div class="divider"></div>
                            <div class="card-content">
                                <h6 class="font-medium">Pengajuan Proposal</h6>
                                <div class="row">
                                    <div class="col s3">
                                        <div class="h-form-label">
                                            <label for="title">Title</label>
                                        </div>
                                    </div>
                                    <div class="input-field col s9">
                                        {!! Form::text('title', $student->file->title, ['placeholder'=>'Title','id'=>'title']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s3">
                                        <div class="h-form-label">
                                            <label for="krs">KRS</label>
                                        </div>
                                    </div>
                                    <div class="input-field col s9">
                                        <span class="input-group-btn">
                                            <a id="fm-1" data-input="krs" data-preview="holder" class="btn btn-primary">
                                                File Upload
                                            </a>
                                        </span>
                                        {!! Form::text('krs', $student->file->krs, ['placeholder'=>'KRS','id'=>'krs','class'=>'form-control','readonly']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s3">
                                        <div class="h-form-label">
                                            <label for="kss">KSS</label>
                                        </div>
                                    </div>
                                    <div class="input-field col s9">
                                        <span class="input-group-btn">
                                            <a id="fm-2" data-input="kss" data-preview="holder" class="btn btn-primary">
                                                File Upload
                                            </a>
                                        </span>
                                        {!! Form::text('kss', $student->file->kss, ['placeholder'=>'KSS','id'=>'kss','class'=>'form-control','readonly']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s3">
                                        <div class="h-form-label">
                                            <label for="proposal">Proposal</label>
                                        </div>
                                    </div>
                                    <div class="input-field col s9">
                                        <span class="input-group-btn">
                                            <a id="fm-3" data-input="proposal" data-preview="holder" class="btn btn-primary">
                                                File Upload
                                            </a>
                                        </span>
                                        {!! Form::text('proposal', $student->file->proposal, ['placeholder'=>'Proposal','id'=>'proposal','class'=>'form-control','readonly']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s3">
                                        <div class="h-form-label">
                                            <label for="paper">Paper</label>
                                        </div>
                                    </div>
                                    <div class="input-field col s9">
                                        <span class="input-group-btn">
                                            <a id="fm-4" data-input="paper" data-preview="holder" class="btn btn-primary">
                                                File Upload
                                            </a>
                                        </span>
                                        {!! Form::text('paper', $student->file->paper, ['placeholder'=>'Paper','id'=>'paper','class'=>'form-control','readonly']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                        </div>
                        <div class="divider"></div>
                        <div class="card-content">
                            <div class="form-action">
                                <button class="btn cyan waves-effect waves-light submit" type="submit" name="action">Submit</button>
                                <a class="btn waves-effect waves-light grey darken-4" href="/student/dashboard/student_profile" name="action">Cancel
                                </a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    @endif --}}
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script src="{{asset('admin/assets/extra-libs/prism/prism.js')}}"></script>
    <script src="{{asset('admin/dist/js/pages/forms/jquery.validate.min.js')}}"></script>
    <script>
        $('#fm-1').filemanager('file');
        $('#fm-2').filemanager('file');
        $('#fm-3').filemanager('file');
        $('#fm-4').filemanager('file');
        $(function() {
            $("#formValidate").validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 5,
                    },
                    krs: {
                        required: true,
                    },
                    kss: {
                        required: true,
                    },
                    proposal: {
                        required: true,
                    },
                    paper: {
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
@endsection