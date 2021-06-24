@extends('layouts.master')

@section('header')
    <link href="{{asset('datetime/jquery.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/extra-libs/prism/prism.css')}}" rel="stylesheet">
    <title>Detail Bimbingan</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Detail Bimbingan</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/lecturer/dashboard/lecturer_profile" class="breadcrumb">Dashboard</a>
                <a href="/lecturer/dashboard/attendance" class="breadcrumb">Absensi Bimbingan</a>
                <a href="/lecturer/student_attendance/{{ $student->id }}" class="breadcrumb">Detail Bimbingan</a>
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
                        <div id="supervisor1">
                            @if(auth()->user()->lecturer->students()->where('student_id',$student->id)->first()->pivot->progress<3)
                                <br>
                                <div class="row">
                                    <div class="col s12">
                                        <h5>Nama Mahasiswa : {{ $student->user->name }} (Dalam Proses Pengajuan)</h5>
                                    </div>
                                    <div class="col s12">
                                        <h5>Sebagai Pembimbing Ke-{{ auth()->user()->lecturer->students()->where('student_id',$student->id)->first()->pivot->order }}</h5>
                                    </div>
                                </div>
                                <hr>
                            @else
                                <br>
                                <div class="row">
                                    <div class="col s6">
                                        <h5>Nama Mahasiswa : {{ $student->user->name }}</h5>
                                    </div>
                                    <div class="col s6 right-align">
                                        <a href="#modal1" class="waves-effect waves-light btn indigo modal-trigger modal-edit1" student-id="{{ $student->id }}" student-name="{{ $student->user->name }}">
                                            Tambah Absensi Baru
                                        </a>
                                    </div>
                                    <div class="col s12">
                                        <h5>Sebagai Pembimbing Ke-{{ auth()->user()->lecturer->students()->where('student_id',$student->id)->first()->pivot->order }}</h5>
                                    </div>
                                </div>
                                <hr>
                            @endif
                            @if($attendance->count()!=0)
                            <table id="student" class="highlight display" style="width:100%">
                                <tbody>
                                    @foreach ($attendance as $key => $attend)
                                    <tr>
                                        <td style="vertical-align:">
                                            <h5>{{ $key+1 }}. {{ $attend->title }}</h5>
                                            <hr>
                                            <p>{{ $attend->description }}</p>
                                            <p>{{ $attend->date_time }}</p>
                                            @if($attend->confirm_student!=0 && $attend->confirm_lecturer!=0)
                                            <p><span class="label label-info">Dikonfirmasi</span></p>
                                            @elseif($attend->confirm_lecturer!=0)
                                            <p><span class="label label-warning">Menunggu Konfirmasi Mahasiswa</span></p>
                                            @else
                                            <p><span class="label label-primary">Menunggu Konfirmasi Dosen</span></p>
                                            @endif
                                            <div class="right">
                                                @if($attend->confirm_lecturer!=1)
                                                <a href="/lecturer/attend/{{ $attend->id }}" class="waves-effect waves-light btn green">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                                @endif
                                                <a href="#modal2" class="waves-effect waves-light btn blue modal-trigger modal-edit2" attendance-id="{{ $attend->id }}" student-name="{{ $attend->student->user->name }}" 
                                                    title="{{ $attend->title }}" description="{{ $attend->description }}" time="{{ substr($attend->date_time,0,-3) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="waves-effect waves-light btn red deletelecturer" attendance-id="{{ $attend->id }}" title="{{ $attend->title }}">
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
                        </div>
                        </div>
                        <div id="modal1" class="modal">
                            <div class="modal-content">
                            <h4>Tambah Absensi Bimbingan Baru</h4>
                            <p>Silakan isi form dibawah ini.</p>
                            {!! Form::open(['url' => '/lecturer/new_attendance','class'=>'formValidate1','id'=>'formValidate1']) !!}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        {!! Form::text('name', '', ['placeholder'=>'Nama Mahasiswa','id'=>'student_name','readonly']) !!}
                                        <label for="student_name">Nama Mahasiswa</label>
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
                                {!! Form::hidden('student_id', '', ['id'=>'student_id']) !!}
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
                            {!! Form::open(['url' => '/lecturer/edit_attendance','class'=>'formValidate2','id'=>'formValidate2']) !!}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        {!! Form::text('name', '', ['placeholder'=>'Nama Mahasiswa','id'=>'student_name_edit','readonly']) !!}
                                        <label for="student_name_edit">Nama Mahasiswa</label>
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
    <script src="{{asset('admin/customjs/lecturer_attendance.js')}}"></script>
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