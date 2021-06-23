@extends('layouts.master')

@section('header')
    <title>Mahasiswa</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Pengelolaan Mahasiswa</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/super_admin/dashboard/data_overview" class="breadcrumb">Dashboard</a>
                <a href="/super_admin/dashboard/students" class="breadcrumb">Pengelolaan Mahasiswa</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content hide-on-small-only">
                        <div class="row">
                            <h3 class="card-title col s6">Tabel Mahasiswa</h3>
                            <div class="col s6">
                                <a href="/studentuser/add" class="right waves-effect waves-light btn indigo">Tambah Mahasiswa</a>
                            </div>
                        </div>         
                        <table id="student" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Nomor Telepon</th>
                                    <th>IPK</th>
                                    <th>Angkatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $key => $student)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $student->npm }}</td>
                                    <td>{{ $student->first_name }}</td>
                                    <td>{{ $student->last_name }}</td>
                                    <td>{{ $student->user->phone }}</td>
                                    <td>{{ $student->gpa }}</td>
                                    <td>{{ $student->angkatan }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletestudent" student-id="{{ $student->id }}" student-name="{{ $student->first_name }} {{ $student->last_name }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Nomor Telepon</th>
                                    <th>IPK</th>
                                    <th>Angkatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-content hide-on-med-and-up">
                        <div class="row">
                            <h3 class="card-title col s6">Tabel Mahasiswa</h3>
                            <div class="col s6">
                                <a href="/studentuser/add" class="right waves-effect waves-light btn indigo">Tambah Mahasiswa</a>
                            </div>
                        </div>         
                        <table id="student1" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Nomor Telepon</th>
                                    <th>IPK</th>
                                    <th>Angkatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $key => $student)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $student->npm }}</td>
                                    <td>{{ $student->first_name }}</td>
                                    <td>{{ $student->last_name }}</td>
                                    <td>{{ $student->user->phone }}</td>
                                    <td>{{ $student->gpa }}</td>
                                    <td>{{ $student->angkatan }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletestudent" student-id="{{ $student->id }}" student-name="{{ $student->first_name }} {{ $student->last_name }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="hide-on-small-only">
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Nomor Telepon</th>
                                    <th>IPK</th>
                                    <th>Angkatan</th>
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
    {{-- <scrip src="{{asset('admin/assets/extra-libs/Datatables/datatables.min.js')}}"></scrip> --}}
    {{-- <scrip src="{{asset('admin/dist/js/pages/datatable/datatable-basic.init.js')}}"></scrip> --}}
    <script>
        $('.deletestudent').click(function(){
            var student_id = $(this).attr('student-id');
            var student_name = $(this).attr('student-name');
            swal({   
                title: "Yakin ?",   
                text: "Hapus mahasiswa dengan nama "+student_name+"?",   
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
                    window.location = "/students/delete/"+student_id;
                }
            });
        });
        $('#student').DataTable();
        $('#student1').DataTable({searching: false});
    </script>
    @if (session('success'))
        <script>
            toastr.success('Hapus Mahasiswa Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
    @if (session('created'))
        <script>
            toastr.success('Tambah User Mahasiswa Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
@endsection