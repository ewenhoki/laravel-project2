@extends('layouts.master')

@section('header')
    <title>Pengajuan Pembimbing</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Daftar Pengajuan Dosen Pembimbing</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/admin/dashboard/admin_profile" class="breadcrumb">Dashboard</a>
                <a href="/admin/dashboard/request" class="breadcrumb">Daftar Pengajuan Dosen Pembimbing</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content hide-on-small-only">
                        <h3 class="card-title">Tabel Daftar Pengajuan Dosen Pembimbing</h3>
                        <table id="student" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Upload Surat Tugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $key=>$student)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $student->npm }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>
                                        <a href="/admin/letter_1/export/{{ $student->id }}" class="waves-effect waves-light btn pink darken-3" target="_blank">Persetujuan</a>
                                        <a href="{{ $student->file->krs }}" class="waves-effect waves-light btn deep-purple darken-3" target="_blank">KRS</a>
                                        <a href="{{ $student->file->kss }}" class="waves-effect waves-light btn indigo indigo darken-1" target="_blank">KSS</a>
                                        <a href="{{ $student->file->proposal }}" class="waves-effect waves-light btn blue darken-2" target="_blank">Proposal</a>
                                        <a href="{{ $student->file->paper }}" class="waves-effect waves-light btn light-blue darken-1" target="_blank">Paper</a>
                                    </td>
                                    <td>
                                        @if($student->file->letter_2==NULL)
                                        <i class="fa fa-circle red-text tooltipped" data-tooltip="Menunggu Surat Tugas dari TU"></i>
                                        @else
                                        <i class="fa fa-circle blue-text tooltipped" data-tooltip="Surat Tugas Sudah Diupload"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/request/upload/{{ $student->id }}" class="waves-effect waves-light btn indigo">
                                            <i class="fas fa-upload"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Upload Surat Tugas</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-content hide-on-med-and-up">
                        <h3 class="card-title">Tabel Daftar Pengajuan Dosen Pembimbing</h3>
                        <table id="student1" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Upload Surat Tugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $key=>$student)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $student->npm }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>
                                        <a href="/admin/letter_1/export/{{ $student->id }}" class="waves-effect waves-light btn pink darken-3" target="_blank">Persetujuan</a>
                                        <a href="{{ $student->file->krs }}" class="waves-effect waves-light btn deep-purple darken-3" target="_blank">KRS</a>
                                        <a href="{{ $student->file->kss }}" class="waves-effect waves-light btn indigo indigo darken-1" target="_blank">KSS</a>
                                        <a href="{{ $student->file->proposal }}" class="waves-effect waves-light btn blue darken-2" target="_blank">Proposal</a>
                                        <a href="{{ $student->file->paper }}" class="waves-effect waves-light btn light-blue darken-1" target="_blank">Paper</a>
                                    </td>
                                    <td>
                                        @if($student->file->letter_2==NULL)
                                        <i class="fa fa-circle red-text tooltipped" data-tooltip="Menunggu Surat Tugas dari TU"></i>
                                        @else
                                        <i class="fa fa-circle blue-text tooltipped" data-tooltip="Surat Tugas Sudah Diupload"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/request/upload/{{ $student->id }}" class="waves-effect waves-light btn indigo">
                                            <i class="fas fa-upload"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="hide-on-small-only">
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Upload Surat Tugas</th>
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    {{-- <script src="{{asset('admin/dist/js/pages/datatable/datatable-basic.init.js')}}"></script> --}}
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
        $('#student1').DataTable({searching: false});
    </script>
    @if (session('accepted'))
        <script>
            toastr.success('Berhasil menyetujui pengajuan dosen pembimbing !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
    @if (session('rejected'))
    <script>
        toastr.success('Berhasil menolak pengajuan dosen pembimbing !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
@endif
@endsection