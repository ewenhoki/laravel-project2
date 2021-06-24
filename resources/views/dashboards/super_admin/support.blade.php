@extends('layouts.master')

@section('header')
    <title>Bantuan</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Daftar Bantuan</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/super_admin/dashboard/data_overview" class="breadcrumb">Dashboard</a>
                <a href="/super_admin/dashboard/support" class="breadcrumb">Daftar Bantuan</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content hide-on-small-only">
                        <h3 class="card-title">Tabel Daftar Bantuan</h3>
                        <table id="student" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th style="width:45%">Pesan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supports as $key => $support)
                                <tr>
                                   <td>{{ $key+1 }}</td>
                                   <td>{{ $support->name }}</td>
                                   <td>{{ $support->email }}</td>
                                   <td>{{ $support->phone }}</td>
                                   <td>{{ $support->message }}</td>
                                   <td>
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletesupport" support-id="{{ $support->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                   </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Pesan</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-content hide-on-med-and-up">
                        <h3 class="card-title">Tabel Daftar Bantuan</h3>
                        <table id="student1" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th style="width:45%">Pesan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supports as $key => $support)
                                <tr>
                                   <td>{{ $key+1 }}</td>
                                   <td>{{ $support->name }}</td>
                                   <td>{{ $support->email }}</td>
                                   <td>{{ $support->phone }}</td>
                                   <td>{{ $support->message }}</td>
                                   <td>
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletesupport" support-id="{{ $support->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                   </td>
                                </tr>
                                @endforeach
                            </tbody>
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
        $('.deletesupport').click(function(){
            var support_id = $(this).attr('support-id');
            swal({   
                title: "Yakin ?",   
                text: "Hapus bantuan ? Anda tidak dapat mengembalikan data yang sudah dihapus.",   
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
                    window.location = "/support/delete/"+support_id;
                }
            });
        });
        $('#student').DataTable();
        $('#student1').DataTable({searching: false});
    </script>
    @if (session('deleted'))
    <script>
        toastr.success('Berhasil menghapus bantuan !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
@endif
@endsection