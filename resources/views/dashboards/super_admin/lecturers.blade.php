@extends('layouts.master')

@section('header')
    <title>Dosen</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Pengelolaan Dosen</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/super_admin/dashboard/data_overview" class="breadcrumb">Dashboard</a>
                <a href="/super_admin/dashboard/lecturers" class="breadcrumb">Pengelolaan Dosen</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <h3 class="card-title col s6">Tabel Dosen</h3>
                            <div class="col s6">
                                <a href="/lectureruser/add" class="right waves-effect waves-light btn indigo">Tambah Dosen</a>
                            </div>
                        </div>
                        <table id="lecturer" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIP</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Nomor Telepon</th>
                                    <th>Jumlah Mahasiswa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lecturers as $key => $lecturer)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $lecturer->nip }}</td>
                                    <td>{{ $lecturer->first_name }}</td>
                                    <td>{{ $lecturer->last_name }}</td>
                                    <td>{{ $lecturer->user->phone }}</td>
                                    <td>{{ $lecturer->students->count() }}</td>
                                    <td>
                                        <a href="#" class="waves-effect waves-light btn red deletelecturer" lecturer-id="{{ $lecturer->id }}" lecturer-name="{{ $lecturer->first_name }} {{ $lecturer->last_name }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>NIP</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Nomor Telepon</th>
                                    <th>Jumlah Mahasiswa</th>
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
        $('.deletelecturer').click(function(){
            var lecturer_id = $(this).attr('lecturer-id');
            var lecturer_name = $(this).attr('lecturer-name');
            swal({   
                title: "Yakin ?",   
                text: "Hapus dosen dengan nama "+lecturer_name+"?",   
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
                    window.location = "/lecturers/delete/"+lecturer_id;
                }
            });
        });
        $('#lecturer').DataTable();
    </script>
    @if (session('success'))
        <script>
            toastr.success('Hapus Dosen Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
    @if (session('created'))
        <script>
            toastr.success('Tambah User Dosen Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
@endsection