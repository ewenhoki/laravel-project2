@extends('layouts.master')

@section('header')
    <title>Math Unpad - Students</title>
    <link href="{{asset('admin/dist/css/pages/data-table.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/libs/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Daftar Pengajuan Dosen Pembimbing</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/super_admin/dashboard/data_overview" class="breadcrumb">Dashboard</a>
                <a href="/super_admin/dashboard/students" class="breadcrumb">Daftar Pengajuan Dosen Pembimbing</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Tabel Daftar Pengajuan Dosen Pembimbing</h3>
                        <table id="student" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Nama Dosen</th>
                                    <th>Pembimbing ke-</th>
                                    <th>Status</th>
                                    <th>Dokumen</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $key => $student)
                                @if($student->lecturers()->wherePivot('order',1)->first())
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $student->npm }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->lecturers()->wherePivot('order',1)->first()->user->name }}</td>
                                    <td>{{ $student->lecturers()->wherePivot('order',1)->first()->pivot->order }}</td>
                                    <td><i class="fa fa-circle {{ $tooltip[$student->lecturers()->wherePivot('order',1)->first()->pivot->progress-1] }}-text tooltipped" data-tooltip="{{ $status[$student->lecturers()->wherePivot('order',1)->first()->pivot->progress-1] }}"></i></td>
                                    <td>
                                        <a href="{{ $student->file->krs }}" class="waves-effect waves-light btn deep-purple darken-3" target="_blank">KRS</a>
                                        <a href="{{ $student->file->kss }}" class="waves-effect waves-light btn indigo indigo darken-1" target="_blank">KSS</a>
                                        <a href="{{ $student->file->proposal }}" class="waves-effect waves-light btn blue darken-2" target="_blank">Proposal</a>
                                        <a href="{{ $student->file->paper }}" class="waves-effect waves-light btn light-blue darken-1" target="_blank">Paper</a>
                                    </td>
                                    <td>
                                        @if($student->lecturers()->wherePivot('order',1)->first()->pivot->progress==1)
                                        <a href="/request/accept/{{ $student->id }}/{{ $student->lecturers()->wherePivot('order',1)->first()->id }}" class="waves-effect waves-light btn blue">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        @endif
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletereq1" student-id="{{ $student->id }}" student-name="{{ $student->user->name }}" lecturer-id="{{ $student->lecturers()->wherePivot('order',1)->first()->id }}">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                @foreach ($students as $key => $student)
                                @if($student->lecturers()->wherePivot('order',2)->first())
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $student->npm }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->lecturers()->wherePivot('order',2)->first()->user->name }}</td>
                                    <td>{{ $student->lecturers()->wherePivot('order',2)->first()->pivot->order }}</td>
                                    <td><i class="fa fa-circle {{ $tooltip[$student->lecturers()->wherePivot('order',2)->first()->pivot->progress-1] }}-text tooltipped" data-tooltip="{{ $status[$student->lecturers()->wherePivot('order',2)->first()->pivot->progress-1] }}"></i></td>
                                    <td>
                                        <a href="{{ $student->file->krs }}" class="waves-effect waves-light btn deep-purple darken-3" target="_blank">KRS</a>
                                        <a href="{{ $student->file->kss }}" class="waves-effect waves-light btn indigo indigo darken-1" target="_blank">KSS</a>
                                        <a href="{{ $student->file->proposal }}" class="waves-effect waves-light btn blue darken-2" target="_blank">Proposal</a>
                                        <a href="{{ $student->file->paper }}" class="waves-effect waves-light btn light-blue darken-1" target="_blank">Paper</a>
                                    </td>
                                    <td>
                                        @if($student->lecturers()->wherePivot('order',2)->first()->pivot->progress==1)
                                        <a href="/request/accept/{{ $student->id }}/{{ $student->lecturers()->wherePivot('order',2)->first()->id }}" class="waves-effect waves-light btn blue">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        @endif
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletereq2" student-id="{{ $student->id }}" student-name="{{ $student->user->name }}" lecturer-id="{{ $student->lecturers()->wherePivot('order',2)->first()->id }}">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Nama Dosen</th>
                                    <th>Pembimbing ke-</th>
                                    <th>Status</th>
                                    <th>Dokumen</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="{{asset('admin/assets/extra-libs/Datatables/datatables.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    {{-- <script src="{{asset('admin/dist/js/pages/datatable/datatable-basic.init.js')}}"></script> --}}
    <script src="{{asset('admin/assets/libs/toastr/build/toastr.min.js')}}"></script>
    <script>
        $('.deletereq1').click(function(){
            var student_id = $(this).attr('student-id');
            var student_name = $(this).attr('student-name');
            var lecturer_id = $(this).attr('lecturer-id');
            swal({   
                title: "Yakin ?",   
                text: "Tolak pengajuan dosen pembimbing 1 untuk mahasiswa bernama "+student_name+"?",   
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
                    window.location = "/request/reject/"+student_id+"/"+lecturer_id;
                }
            });
        });
        $('.deletereq2').click(function(){
            var student_id = $(this).attr('student-id');
            var student_name = $(this).attr('student-name');
            var lecturer_id = $(this).attr('lecturer-id');
            swal({   
                title: "Yakin ?",   
                text: "Tolak pengajuan dosen pembimbing 2 untuk mahasiswa bernama "+student_name+"?",   
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
                    window.location = "/request/reject/"+student_id+"/"+lecturer_id;
                }
            });
        });
        $('#student').DataTable();
    </script>
    @if (session('success'))
        <script>
            toastr.success('Lecturer Delete Success !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
@endsection