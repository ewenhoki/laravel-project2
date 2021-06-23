@extends('layouts.master')

@section('header')
    <title>Persetujuan Dokumen</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Daftar Pengajuan Persetujuan Dokumen</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/super_admin/dashboard/data_overview" class="breadcrumb">Dashboard</a>
                <a href="/super_admin/dashboard/documents" class="breadcrumb">Daftar Pengajuan Persetujuan Dokumen</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content hide-on-small-only">
                        <h3 class="card-title">Tabel Daftar Pengajuan Persetujuan Dokumen</h3>
                        <table id="student" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Judul</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $key => $file)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $file->student->npm }}</td>
                                    <td>{{ $file->student->user->name }}</td>
                                    <td>{{ $file->title }}</td>
                                    <td>
                                        <a href="{{ $file->krs }}" class="waves-effect waves-light btn deep-purple darken-3" target="_blank">KRS</a>
                                        <a href="{{ $file->kss }}" class="waves-effect waves-light btn indigo indigo darken-1" target="_blank">KSS</a>
                                        <a href="{{ $file->proposal }}" class="waves-effect waves-light btn blue darken-2" target="_blank">Proposal</a>
                                        <a href="{{ $file->paper }}" class="waves-effect waves-light btn light-blue darken-1" target="_blank">Paper</a>
                                    </td>
                                    <td>
                                        @if($file->letter_1==NULL)
                                        <i class="fa fa-circle red-text tooltipped" data-tooltip="Menunggu Surat Persetujuan Dokumen"></i>
                                        @else
                                        <i class="fa fa-circle blue-text tooltipped" data-tooltip="Dokumen Disetujui"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/request/upload/{{ $file->student->id }}" class="waves-effect waves-light btn indigo">
                                            <i class="fas fa-upload"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletereq1" file-id="{{ $file->id }}" student-name="{{ $file->student->user->name }}">
                                            <i class="fas fa-times"></i>
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
                                    <th>Judul</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-content hide-on-med-and-up">
                        <h3 class="card-title">Tabel Daftar Pengajuan Persetujuan Dokumen</h3>
                        <table id="student1" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Judul</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $key => $file)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $file->student->npm }}</td>
                                    <td>{{ $file->student->user->name }}</td>
                                    <td>{{ $file->title }}</td>
                                    <td>
                                        <a href="{{ $file->krs }}" class="waves-effect waves-light btn deep-purple darken-3" target="_blank">KRS</a>
                                        <a href="{{ $file->kss }}" class="waves-effect waves-light btn indigo indigo darken-1" target="_blank">KSS</a>
                                        <a href="{{ $file->proposal }}" class="waves-effect waves-light btn blue darken-2" target="_blank">Proposal</a>
                                        <a href="{{ $file->paper }}" class="waves-effect waves-light btn light-blue darken-1" target="_blank">Paper</a>
                                    </td>
                                    <td>
                                        @if($file->letter_1==NULL)
                                        <i class="fa fa-circle red-text tooltipped" data-tooltip="Menunggu Surat Persetujuan Dokumen"></i>
                                        @else
                                        <i class="fa fa-circle blue-text tooltipped" data-tooltip="Dokumen Disetujui"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/request/upload/{{ $file->student->id }}" class="waves-effect waves-light btn indigo">
                                            <i class="fas fa-upload"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletereq1" file-id="{{ $file->id }}" student-name="{{ $file->student->user->name }}">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="hide-on-small-only">
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Judul</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
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
            var file_id = $(this).attr('file-id');
            var student_name = $(this).attr('student-name');
            swal({   
                title: "Yakin ?",   
                text: "Tolak pengajuan dokumen untuk mahasiswa bernama "+student_name+"?",   
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
                    window.location = "/documents/reject/"+file_id;
                }
            });
        });
        $('#student').DataTable();
        $('#student1').DataTable({searching: false});
    </script>
    @if (session('deleted'))
        <script>
            toastr.success('Berhasil menolak pengajuan dokumen !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
@endsection