@extends('layouts.master')

@section('header')
    <title>Dashboard</title>
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> --}}
@endsection

@section('content')
<div class="page-wrapper page-header">
    <div class="card info-gradient m-t-0 m-b-0">
        <div class="card-content">
            <div class="p-b-40 p-t-20">
                <h3 class="white-text">Selamat Datang {{ auth()->user()->name }} !</h3>
                <p class="white-text op-7 m-b-20">Scroll ke bawah untuk melakukan manajemen pengguna.</p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col l3 m6 s12">
                <div class="card danger-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">{{ $users->count() }}</h2>
                                <h6 class="white-text op-5 light-blue-text">Total User</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">account_box</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col l3 m6 s12">
                <div class="card primary-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">{{ $students->count() }}</h2></h2>
                                <h6 class="white-text op-5">Total Mahasiswa</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">assignment_ind</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col l3 m6 s12">
                <div class="card success-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">{{ $lecturers->count() }}</h2>
                                <h6 class="white-text op-5 text-darken-2">Total Dosen</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">account_circle</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col l3 m6 s12">
                <div class="card warning-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">45</h2>
                                <h6 class="white-text op-5">Menunggu Persetujuan</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">assignment</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <h3 class="card-title col s6">Tabel Pengguna</h3>
                            <div class="col s6">
                                <a href="/users/add" class="right waves-effect waves-light btn indigo">Tambah User Admin</a>
                            </div>
                        </div>
                        <table id="zero_config" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Dibuat Di</th>
                                    <th>Status</th>
                                    <th>Last Seen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        @if($user->role=='Super Admin')
                                            <span class="label label-info">{{ $user->role }}</span>
                                        @elseif($user->role=='Student')
                                            <span class="label label-warning">Mahasiswa</span>
                                        @elseif($user->role=='Lecturer')
                                            <span class="label label-primary">Dosen</span>
                                        @else
                                            <span class="label cyan">{{ $user->role }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        @if(Cache::has('is_online' . $user->id))
                                            <span class="label label-success">Online</span>
                                        @else
                                            <span class="label label-inverse">Offline</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</td>
                                    <td>
                                        @if ($user->role=='Super Admin')
                                            <a href="javascript:void(0);" class="disabled waves-effect waves-light btn red deleteu" user-id="{{ $user->id }}"><i class="fas fa-trash-alt"></i></a>
                                        @else
                                            <a href="javascript:void(0);" class="waves-effect waves-light btn red deleteu" user-id="{{ $user->id }}" user-name="{{ $user->name }}"><i class="fas fa-trash-alt"></i></a>
                                            @if(is_null($user->email_verified_at))
                                                <a href="/users/verifbyadmin/{{$user->id}}" class="waves-effect waves-light btn blue"><i class="fas fa-check"></i></a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Dibuat Di</th>
                                    <th>Status</th>
                                    <th>Last Seen</th>
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
    {{-- <script src="{{asset('admin/assets/extra-libs/Datatables/datatables.min.js')}}"></script> --}}
    {{-- <script src="{{asset('admin/dist/js/pages/datatable/datatable-basic.init.js')}}"></script> --}}
    <script>
        $('.deleteu').click(function(){
            var user_id = $(this).attr('user-id');
            var user_name = $(this).attr('user-name');
            swal({   
                title: "Yakin ?",   
                text: "Hapus user dengan nama "+user_name+"?",   
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
                    window.location = "/users/delete/"+user_id;
                }
            });
        });
        $('#zero_config').DataTable();
    </script>
    @if (session('success'))
    <script>
        toastr.success('Hapus User Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
    @if (session('created'))
    <script>
        toastr.success('Tambah User Admin Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
    @if (session('verif'))
    <script>
        toastr.success('Verifikasi User Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
@endsection
