@extends('layouts.master')

@section('header')
    <link href="{{asset('datetime/jquery.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/extra-libs/prism/prism.css')}}" rel="stylesheet">
    <title>Absensi Bimbingan</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Absensi Bimbingan</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/student/dashboard/student_profile" class="breadcrumb">Dashboard</a>
                <a href="/student/dashboard/attendance" class="breadcrumb">Absensi Bimbingan</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Tabel Absensi Bimbingan</h3>
                        <hr>
                        <div class="card-tabs">
                            <ul class="tabs tabs-fixed-width">
                                <li class="tab"><a class="active" href="#supervisor1">Pembimbing 1</a></li>
                                <li class="tab"><a class="" href="#supervisor2">Pembimbing 2</a></li>
                            </ul>
                        </div>
                        <div id="supervisor1">
                            @if($attendance_1!=NULL)
                                @if(auth()->user()->student->lecturers()->wherePivot('order',1)->first())
                                    @if(auth()->user()->student->lecturers()->wherePivot('order',1)->first()->pivot->progress<3)
                                    <br>
                                    <h5>Nama Dosen : {{ auth()->user()->student->lecturers()->wherePivot('order',1)->first()->user->name }} (Dalam Proses Pengajuan)</h5>
                                    <hr>
                                    @else
                                    <br>
                                    <div class="row">
                                        <div class="col s6">
                                            <h5>Nama Dosen : {{ auth()->user()->student->lecturers()->wherePivot('order',1)->first()->user->name }}</h5>
                                        </div>
                                        <div class="col s6 right-align">
                                            <a href="#modal1" class="waves-effect waves-light btn indigo modal-trigger modal-edit1" lecturer-id="{{ auth()->user()->student->lecturers()->wherePivot('order',1)->first()->id }}" lecturer-name="{{ auth()->user()->student->lecturers()->wherePivot('order',1)->first()->user->name }}">
                                                Tambah Absensi Baru
                                            </a>
                                            <a href="/student/attendance/export" class="waves-effect waves-light btn cyan">
                                                Export PDF
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                    @endif
                                @endif
                                @if($attendance_1->count()!=0)
                                <table id="student" class="responsive-table highlight display" style="width:100%">
                                    <tbody>
                                        @foreach ($attendance_1 as $key => $attend_1)
                                        <tr>
                                            <td style="vertical-align:">
                                                <h5>{{ $key+1 }}. {{ $attend_1->title }}</h5>
                                                <hr>
                                                <p>{{ $attend_1->description }}</p>
                                                <p>{{ $attend_1->date_time }}</p>
                                                @if($attend_1->confirm_student!=0 && $attend_1->confirm_lecturer!=0)
                                                <p><span class="label label-info">Dikonfirmasi</span></p>
                                                @elseif($attend_1->confirm_lecturer!=0)
                                                <p><span class="label label-warning">Menunggu Konfirmasi Mahasiswa</span></p>
                                                @else
                                                <p><span class="label label-primary">Menunggu Konfirmasi Dosen</span></p>
                                                @endif
                                                <div class="right">
                                                    @if($attend_1->confirm_student!=1)
                                                    <a href="/student/attend/{{ $attend_1->id }}" class="waves-effect waves-light btn green">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                    @endif
                                                    <a href="#modal2" class="waves-effect waves-light btn blue modal-trigger modal-edit2" attendance-id="{{ $attend_1->id }}" lecturer-name="{{ $attend_1->lecturer->user->name }}" 
                                                        title="{{ $attend_1->title }}" description="{{ $attend_1->description }}" time="{{ substr($attend_1->date_time,0,-3) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="waves-effect waves-light btn red deletelecturer" attendance-id="{{ $attend_1->id }}" title="{{ $attend_1->title }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <div class="card-content">
                                    <h5>Belum Ada Aktivitas</h5>
                                </div>
                                <hr>
                                @endif
                            @else
                            <div class="card-content">
                                <h5>Belum Melakukan Pengajuan</h5>
                            </div>
                            <hr>
                            @endif
                        </div>
                            <div id="supervisor2">
                                @if($attendance_2!=NULL)
                                    @if(auth()->user()->student->lecturers()->wherePivot('order',2)->first())
                                        @if(auth()->user()->student->lecturers()->wherePivot('order',2)->first()->pivot->progress<3)
                                        <br>
                                        <h5>Nama Dosen : {{ auth()->user()->student->lecturers()->wherePivot('order',2)->first()->user->name }} (Dalam Proses Pengajuan)</h5>
                                        <hr>
                                        @else
                                        <br>
                                        <div class="row">
                                            <div class="col s6">
                                                <h5>Nama Dosen : {{ auth()->user()->student->lecturers()->wherePivot('order',2)->first()->user->name }}</h5>
                                            </div>
                                            <div class="col s6 right-align">
                                                <a href="#modal1" class="waves-effect waves-light btn indigo modal-trigger modal-edit1" lecturer-id="{{ auth()->user()->student->lecturers()->wherePivot('order',2)->first()->id }}" lecturer-name="{{ auth()->user()->student->lecturers()->wherePivot('order',2)->first()->user->name }}">
                                                    Tambah Absensi Baru
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                        @endif
                                    @endif
                                    @if($attendance_2->count()!=0)
                                    <table id="student" class="responsive-table highlight display" style="width:100%">
                                        <tbody>
                                            @foreach ($attendance_2 as $key => $attend_2)
                                            <tr>
                                                <td style="vertical-align:">
                                                    <h5>{{ $key+1 }}. {{ $attend_2->title }}</h5>
                                                    <hr>
                                                    <p>{{ $attend_2->description }}</p>
                                                    <p>{{ $attend_2->date_time }}</p>
                                                    @if($attend_2->confirm_student!=0 && $attend_2->confirm_lecturer!=0)
                                                    <p><span class="label label-info">Dikonfirmasi</span></p>
                                                    @elseif($attend_2->confirm_lecturer!=0)
                                                    <p><span class="label label-warning">Menunggu Konfirmasi Mahasiswa</span></p>
                                                    @else
                                                    <p><span class="label label-primary">Menunggu Konfirmasi Dosen</span></p>
                                                    @endif
                                                    <div class="right">
                                                        @if($attend_2->confirm_student!=1)
                                                        <a href="/student/attend/{{ $attend_2->id }}" class="waves-effect waves-light btn green">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                        @endif
                                                        <a href="#modal2" class="waves-effect waves-light btn blue modal-trigger modal-edit2" attendance-id="{{ $attend_2->id }}" lecturer-name="{{ $attend_2->lecturer->user->name }}" 
                                                            title="{{ $attend_2->title }}" description="{{ $attend_2->description }}" time="{{ substr($attend_2->date_time,0,-3) }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletelecturer" attendance-id="{{ $attend_2->id }}" title="{{ $attend_2->title }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <div class="card-content">
                                        <h5>Belum Ada Aktivitas</h5>
                                    </div>
                                    <hr>
                                    @endif
                                @else
                                <div class="card-content">
                                    <h5>Belum Melakukan Pengajuan</h5>
                                </div>
                                <hr>
                                @endif
                            </div>
                        </div>
                        <div id="modal1" class="modal">
                            <div class="modal-content">
                            <h4>Tambah Absensi Bimbingan Baru</h4>
                            <p>Silakan isi form dibawah ini.</p>
                            {!! Form::open(['url' => '/student/new_attendance','class'=>'formValidate1','id'=>'formValidate1']) !!}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        {!! Form::text('name', '', ['placeholder'=>'Nama Dosen','id'=>'lecturer_name','readonly']) !!}
                                        <label for="lecturer_name">Nama Dosen</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">title</i>
                                        {!! Form::text('title', '', ['id'=>'title']) !!}
                                        <label for="title">Judul</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">description</i>
                                        {!! Form::text('description', '', ['id'=>'description']) !!}
                                        <label for="description">Deskripsi</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">access_time</i>
                                        {!! Form::text('date_time', '', ['id'=>'time','autocomplete'=>'off']) !!}
                                        <label for="time">Waktu</label>
                                    </div>
                                </div>
                                {!! Form::hidden('lecturer_id', '', ['id'=>'lecturer_id']) !!}
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-red btn-flat ">Tutup</a>
                                <button class="modal-action modal-close waves-effect waves-red btn-flat" type="submit" name="action">Kirim</button>
                            </div>
                            {!! Form::close() !!}                
                        </div>
                        <div id="modal2" class="modal">
                            <div class="modal-content">
                            <h4>Ubah Absensi Bimbingan</h4>
                            <p>Silakan lengkapi form dibawah ini.</p>
                            {!! Form::open(['url' => '/student/edit_attendance','class'=>'formValidate2','id'=>'formValidate2']) !!}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        {!! Form::text('name', '', ['placeholder'=>'Nama Dosen','id'=>'lecturer_name_edit','readonly']) !!}
                                        <label for="lecturer_name">Nama Dosen</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">title</i>
                                        {!! Form::text('title', '', ['id'=>'title_edit','placeholder'=>'']) !!}
                                        <label for="title">Judul</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">description</i>
                                        {!! Form::text('description', '', ['id'=>'description_edit','placeholder'=>'']) !!}
                                        <label for="description">Deskripsi</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">access_time</i>
                                        {!! Form::text('date_time', '', ['id'=>'time_edit','placeholder'=>'']) !!}
                                        <label for="time">Waktu</label>
                                    </div>
                                </div>
                                {!! Form::hidden('id', '', ['id'=>'attendance_id']) !!}
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-red btn-flat ">Tutup</a>
                                <button class="modal-action modal-close waves-effect waves-red btn-flat" type="submit" name="action">Kirim</button>
                            </div>
                            {!! Form::close() !!}                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="{{asset('datetime/jquery.datetimepicker.full.js')}}"></script>
    <script src="{{asset('admin/assets/extra-libs/prism/prism.js')}}"></script>
    <script src="{{asset('admin/dist/js/pages/forms/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin/customjs/attendance.js')}}"></script>
    @if (session('created'))
        <script>
            toastr.success('Tambah Absensi Bimbingan Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
    @if (session('attend'))
        <script>
            toastr.success('Konfirmasi Hadir Bimbingan Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
    @if (session('updated'))
        <script>
            toastr.success('Perbaharui Data Bimbingan Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
    @if (session('deleted'))
        <script>
            toastr.success('Hapus Data Bimbingan Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
@endsection