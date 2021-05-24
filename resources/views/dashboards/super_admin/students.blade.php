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
            <h5 class="font-medium m-b-0">Students Management</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/super_admin/dashboard/data_overview" class="breadcrumb">Dashboard</a>
                <a href="/super_admin/dashboard/students" class="breadcrumb">Students Management</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Students Table</h3>
                        <a href="/studentuser/add" class="right waves-effect waves-light btn indigo">Add Students</a>
                        <table id="student" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone Number</th>
                                    <th>GPA</th>
                                    <th>Class of</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
                                        <span class="label label-danger">Pending</span>
                                    </td>
                                    <td>
                                        <a href="#" class="waves-effect waves-light btn red deletestudent" student-id="{{ $student->id }}" student-name="{{ $student->first_name }} {{ $student->last_name }}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone Number</th>
                                    <th>GPA</th>
                                    <th>Class of</th>
                                    <th>Status</th>
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
        $('.deletestudent').click(function(){
            var student_id = $(this).attr('student-id');
            var student_name = $(this).attr('student-name');
            swal({   
                title: "Are you sure?",   
                text: "You will not be able to recover student "+student_name+".",   
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
                    window.location = "/students/delete/"+student_id;
                }
            });
        });
        $('#student').DataTable();
    </script>
    @if (session('success'))
        <script>
            toastr.success('Student Delete Success !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
    @if (session('created'))
        <script>
            toastr.success('Add Student User Success !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
@endsection