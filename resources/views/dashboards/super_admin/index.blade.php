@extends('layouts.master')

@section('header')
    <title>Math Unpad - Dashboard</title>
    <link href="{{asset('admin/dist/css/pages/data-table.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/libs/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="page-wrapper page-header">
    <div class="card info-gradient m-t-0 m-b-0">
        <div class="card-content">
            <div class="p-b-40 p-t-20">
                <h3 class="white-text">Welcome back {{ auth()->user()->name }} !</h3>
                <p class="white-text op-7 m-b-20">Success is not a destination, its a Journey!!!</p>
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
                                <h6 class="white-text op-5 light-blue-text">Users</h6>
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
                                <h6 class="white-text op-5">Students</h6>
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
                                <h6 class="white-text op-5 text-darken-2">Lecturers</h6>
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
                                <h6 class="white-text op-5">Posts</h6>
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
                        <h3 class="card-title">Users Table</h3>
                        <a href="/users/add" class="right waves-effect waves-light btn indigo">Add Admin User</a>
                        <table id="zero_config" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Last Seen</th>
                                    <th>Action</th>
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
                                            <span class="label label-warning">{{ $user->role }}</span>
                                        @elseif($user->role=='Lecturer')
                                            <span class="label label-primary">{{ $user->role }}</span>
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
                                            <a href="#" class="disabled waves-effect waves-light btn red deleteu" user-id="{{ $user->id }}">Delete</a>
                                        @else
                                            <a href="#" class="waves-effect waves-light btn red deleteu" user-id="{{ $user->id }}" user-name="{{ $user->name }}">Delete</a>
                                            @if(is_null($user->email_verified_at))
                                                <a href="/users/verifbyadmin/{{$user->id}}" class="waves-effect waves-light btn blue">Verify</a>
                                            @endif
                                        @endif
                                        {{-- <form action="/users/{{$user->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            @if ($user->role=='Super Admin')
                                            <button type="submit" class="disabled waves-effect waves-light btn red"> 
                                                Delete
                                            </button>
                                            @else
                                            <button type="submit" class="waves-effect waves-light btn red"> 
                                                Delete
                                            </button>
                                            @endif
                                        </form> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Last Seen</th>
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
    <script src="{{asset('admin/assets/libs/toastr/build/toastr.min.js')}}"></script>
    {{-- <script src="{{asset('admin/dist/js/pages/datatable/datatable-basic.init.js')}}"></script> --}}
    <script>
        $(document).ready(function () {
        $('.deleteu').click(function(){
            var user_id = $(this).attr('user-id');
            var user_name = $(this).attr('user-name');
            swal({   
                title: "Are you sure?",   
                text: "You will not be able to recover user "+user_name+".",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes, delete it !",   
                cancelButtonText: "No, cancel !",   
                closeOnConfirm: false,   
                closeOnCancel: false 
            })
            .then(function(WillDelete){
                if(WillDelete.value){
                    window.location = "/users/delete/"+user_id;
                }
            });
        });
        $('#zero_config').DataTable({
            select:true,
        });
        });
    </script>
    @if (session('success'))
    <script>
        toastr.success('User Delete Success !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
    @if (session('created'))
    <script>
        toastr.success('Add Admin User Success !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
@endsection
