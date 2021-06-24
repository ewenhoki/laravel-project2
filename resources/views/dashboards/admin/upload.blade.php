@extends('layouts.master')

@section('header')
    <title>Profil & Upload</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Profil & Upload Surat</h5>
            <div class="custom-breadcrumb ml-auto">
                @if(auth()->user()->role=='Admin')
                <a href="/admin/dashboard/admin_profile" class="breadcrumb">Dashboard</a>
                <a href="/admin/dashboard/request" class="breadcrumb">Daftar Pengajuan Dosen Pembimbing</a>
                <a href="/request/upload/{{ $student->id }}" class="breadcrumb">Profil & Upload Surat Tugas</a>
                @elseif(auth()->user()->role=='Super Admin')
                <a href="/super_admin/dashboard/data_overview" class="breadcrumb">Dashboard</a>
                <a href="/super_admin/dashboard/documents" class="breadcrumb">Daftar Pengajuan Persetujuan Dokumen</a>
                <a href="/request/upload/{{ $student->id }}" class="breadcrumb">Profil & Upload Surat Tugas</a>
                @endif
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12 m4">
                <div class="card">
                    <img class="responsive-img" src="{{ asset('admin/assets/images/big/socialbg.jpg')}}" height="456" alt="Card image">
                    <div class="card-img-overlay white-text social-profile d-flex justify-content-center">
                        <div class="align-self-center">
                            @if($student->user->avatar!=NULL)
                                @if(file_exists(public_path($student->user->avatar)))
                                <img src="{{ $student->user->avatar }}" class="circle" width="100" height="100">
                                @else
                                <img src="{{ asset('admin/img/profile-default.png')}}" class="circle" width="100">
                                @endif
                            @else
                            <img src="{{ asset('admin/img/profile-default.png')}}" class="circle" width="100">
                            @endif
                            <h4 class="card-title white-text">{{ $student->user->name }}</h4>
                            <h6 class="card-subtitle">{{ $student->user->role }}</h6>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <small>Email </small>
                        <h6>{{ $student->user->email }}</h6>
                        <small>Nomor Telepon </small>
                        <h6>{{ $student->user->phone }}</h6>
                        <small>NPM</small>
                        <h6>{{ $student->npm }}</h6>
                        <small>Nama Depan</small>
                        <h6>{{ $student->first_name }}</h6>
                        <small>Nama Belakang</small>
                        <h6>{{ $student->last_name }}</h6>
                        <small>IPK</small>
                        <h6>{{ $student->gpa }}</h6>
                        <small>Dosen Pembimbing 1</small>
                        @if($student->lecturers()->wherePivot('order',1)->first())
                            <h6>{{ $student->lecturers()->wherePivot('order',1)->first()->user->name }}</h6>
                            @if($student->lecturers()->wherePivot('order',1)->first()->pivot->progress<3)
                                <h6> (Dalam Proses Pengajuan)</h6>
                            @endif
                        @else
                            <h6>-</h6>
                        @endif
                        <small>Dosen Pembimbing 2</small>
                        @if($student->lecturers()->wherePivot('order',2)->first())
                            <h6>{{ $student->lecturers()->wherePivot('order',2)->first()->user->name }}</h6>
                            @if($student->lecturers()->wherePivot('order',2)->first()->pivot->progress<3)
                                <h6> (Dalam Proses Pengajuan)</h6>
                            @endif
                        @else
                            <h6>-</h6>
                        @endif
                        @if($student->file->title!=NULL)
                        <small>Judul Tugas Akhir</small>
                        <h6>{{ $student->file->title }}</h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col s12 m8">
                <div class="card">
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s3"><a class="active" href="#accept">Surat Persetujuan</a></li>
                                <li class="tab col s3"><a class="" href="#task">Surat Tugas</a></li>
                            </ul>
                        </div>
                        <div id="accept" class="col s12">
                            <div class="card-content">
                                <div class="profiletimeline">
                                    <div class="sl-item">              
                                        <div class="sl-right">
                                            <div>
                                                <div class="row m-t-30">
                                                    @if($student->file)
                                                        <a href="javascript:void(0)" class="">{{ $student->user->name }}</a>
                                                        @if($student->file->letter_1==NULL)
                                                            <p>Pengajuan dokumen menunggu persetujuan kepala program studi.</p>
                                                        @else
                                                            <p>Pengajuan dokumen telah disetujui.</p>
                                                        @endif
                                                    @else
                                                        <p>Belum melakukan upload dokumen.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(auth()->user()->role=='Super Admin')
                                    @if($student->file)
                                    <hr>
                                    @if($student->file->letter_1 == NULL)
                                    <a href="/postuploadletter1/{{ $student->id }}" class="green accent-4 btn-large">Setujui Pengajuan Tugas Akhir</a>
                                    @else
                                    <a href="/super_admin/letter_1/export/{{ $student->id }}" class="blue accent-4 btn-large">Download Surat Persetujuan</a>
                                    @endif
                                        {{-- {!! Form::open(['url' => '/postuploadletter1/'.$student->id,'class'=>'formValidate','id'=>'formValidate']) !!}       
                                            <div class="file-field input-field">
                                                <div>
                                                    <a class="btn blue darken-1" id="fm-1" data-input="letter_1" data-preview="holder">Upload Surat Persetujuan</a>
                                                </div>
                                                <div class="file-path-wrapper">
                                                    {!! Form::text('letter_1',$student->file->letter_1, ['placeholder'=>'Surat Persetujuan','id'=>'letter_1','class'=>'form-control','readonly']) !!}
                                                </div>
                                            </div>          
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    @if($student->file->letter_1==NULL)
                                                        <button class="btn info waves-effect waves-light right" type="submit" name="action">Kirim</button>
                                                    @else
                                                        <button class="btn info waves-effect waves-light right" type="submit" name="action">Perbaharui</button>
                                                    @endif
                                                </div>
                                            </div>
                                        {!! Form::close() !!} --}}
                                    @endif
                                @else
                                    @if($student->file->letter_1!=NULL)
                                        <hr>
                                        <a href="/admin/letter_1/export/{{ $student->id }}" class="blue accent-4 btn-large" target="_blank">Download Surat Persetujuan</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div id="task" class="col s12">
                            <div class="card-content">
                                <div class="profiletimeline">
                                    <div class="sl-item">              
                                        <div class="sl-right">
                                            <div>
                                                <div class="row m-t-30">
                                                    @if($student->lecturers()->wherePivot('order',1)->first() && $student->lecturers()->wherePivot('order',2)->first())
                                                        <a href="javascript:void(0)" class="">{{ $student->user->name }}</a>
                                                        @if($student->lecturers()->wherePivot('order',1)->first()->pivot->progress<2)
                                                            <p>Pengajuan masih menunggu persetujuan dosen pembimbing 1.</p>
                                                        @elseif($student->lecturers()->wherePivot('order',2)->first()->pivot->progress<2)
                                                            <p>Pengajuan masih menunggu persetujuan dosen pembimbing 2.</p>
                                                        @else
                                                            <p>Pengajuan telah disetujui, silakan upload surat tugas dengan menekan tombol upload dibawah ini.</p>
                                                        @endif
                                                    @else
                                                        @if($student->lecturers()->wherePivot('order',1)->first()==NULL && $student->lecturers()->wherePivot('order',2)->first()==NULL)
                                                            <p>Belum mengajukan dosen pembimbing.</p>
                                                        @elseif($student->lecturers()->wherePivot('order',1)->first()==NULL)
                                                            <p>Belum mengajukan dosen pembimbing 1.</p>
                                                        @elseif($student->lecturers()->wherePivot('order',2)->first()==NULL)
                                                            <p>Belum mengajukan dosen pembimbing 2.</p>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(auth()->user()->role=='Admin')
                                    @if($student->lecturers()->wherePivot('order',1)->first()->pivot->progress>=2 && $student->lecturers()->wherePivot('order',2)->first()->pivot->progress>=2)
                                    <hr>
                                        {!! Form::open(['url' => '/postuploadletter2/'.$student->id,'class'=>'formValidate','id'=>'formValidate']) !!}       
                                            <div class="file-field input-field">
                                                <div>
                                                    <a class="btn blue darken-1" id="fm-2" data-input="letter_2" data-preview="holder">Upload Surat Tugas</a>
                                                </div>
                                                <div class="file-path-wrapper">
                                                    {!! Form::text('letter_2',$student->file->letter_2, ['placeholder'=>'Surat Tugas','id'=>'letter_2','class'=>'form-control','readonly']) !!}
                                                </div>
                                            </div>          
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    @if($student->file->letter_2==NULL)
                                                        <button class="btn info waves-effect waves-light right" type="submit" name="action">Kirim</button>
                                                    @else
                                                        <button class="btn info waves-effect waves-light right" type="submit" name="action">Perbaharui</button>
                                                    @endif
                                                </div>
                                            </div>
                                        {!! Form::close() !!}
                                    @endif
                                @else
                                    @if($student->file->letter_2!=NULL)
                                        <hr>
                                        <a href="{{ $student->file->letter_2 }}" class="blue accent-4 btn-large" target="_blank">Download Surat Tugas</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Container fluid scss in scafholding.scss -->
    <!-- ============================================================== -->
</div>
@endsection

@section('footer')
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script src="{{asset('admin/dist/js/pages/forms/jquery.validate.min.js')}}"></script>
    <script>
        // $('#fm-1').filemanager('file');
        $('#fm-2').filemanager('file');
        $(function() {
            $("#formValidate").validate({
                rules: {
                    letter_1: {
                        required: true,
                    },
                    letter_2: {
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
    @if (session('sent'))
     <script>
         toastr.success('Upload Surat Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
     </script>
    @endif
@endsection