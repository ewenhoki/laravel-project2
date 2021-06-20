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
                <a href="/lecturer/dashboard/lecturer_profile" class="breadcrumb">Dashboard</a>
                <a href="/lecturer/dashboard/attendance" class="breadcrumb">Absensi Bimbingan</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- .col -->
            @foreach($students as $key => $student)
            <div class="col m6">
                <div class="card">
                    <div class="card-content">
                        <div class="row d-flex align-items-center">
                            <div class="col m4 l3 center-align">
                                <a href="app-contact-detail.html"><img src="{{ asset('admin/img/profile-default.png')}}" alt="user" class="circle responsive-img"></a>
                            </div>
                            <div class="col m8 l9">
                                @if($student->attendances->where('lecturer_id',auth()->user()->lecturer->id)->where('confirm_lecturer',0)->count()!=0)
                                <a href="/lecturer/student_attendance/{{ $student->id }}"><h4 class="m-b-0 red-text text-darken-2">{{ $student->user->name }}</h4></a>
                                @else
                                <a href="/lecturer/student_attendance/{{ $student->id }}"><h4 class="m-b-0">{{ $student->user->name }}</h4></a>
                                @endif
                                <address>
                                    {{ $student->npm }}
                                    </br>
                                    IPK : {{ $student->gpa }}
                                    </br>
                                    Jumlah Bimbingan : {{ $student->attendances->where('lecturer_id',auth()->user()->lecturer->id)->count() }}
                                    </br>
                                    Menunggu Persetujuan : {{ $student->attendances->where('lecturer_id',auth()->user()->lecturer->id)->where('confirm_lecturer',0)->count() }}
                                    </br>
                                    <abbr title="Phone">Nomor Telepon:</abbr> {{ $student->user->phone }}
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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