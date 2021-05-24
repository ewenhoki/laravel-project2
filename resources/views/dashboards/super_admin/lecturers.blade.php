@extends('layouts.master')

@section('header')
    <title>Math Unpad - Lecturers</title>
    <link href="{{asset('admin/dist/css/pages/data-table.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/libs/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Lecturers Management</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/super_admin/dashboard/data_overview" class="breadcrumb">Dashboard</a>
                <a href="/super_admin/dashboard/lecturers" class="breadcrumb">Lecturers Management</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Lecturers Table</h3>
                        <a href="/lectureruser/add" class="right waves-effect waves-light btn indigo">Add Lecturers</a>
                        <table id="lecturer" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIP</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
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
                                    <td>
                                        <a href="#" class="waves-effect waves-light btn red deletelecturer" lecturer-id="{{ $lecturer->id }}" lecturer-name="{{ $lecturer->first_name }} {{ $lecturer->last_name }}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>NIP</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone Number</th>
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
        $('.deletelecturer').click(function(){
            var lecturer_id = $(this).attr('lecturer-id');
            var lecturer_name = $(this).attr('lecturer-name');
            swal({   
                title: "Are you sure?",   
                text: "You will not be able to recover lecturer "+lecturer_name+".",   
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
                    window.location = "/lecturers/delete/"+lecturer_id;
                }
            });
        });
        $('#lecturer').DataTable();
    </script>
    @if (session('success'))
        <script>
            toastr.success('Lecturer Delete Success !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
    @if (session('created'))
        <script>
            toastr.success('Add Lecturer User Success !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
@endsection