@extends('layouts.master')

@section('header')
    <title>Kolokium</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Daftar Pengajuan Kolokium</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/super_admin/dashboard/data_overview" class="breadcrumb">Dashboard</a>
                <a href="/super_admin/dashboard/colloquium" class="breadcrumb">Daftar Pengajuan Kolokium</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content hide-on-small-only">
                        <h3 class="card-title">Tabel Daftar Pengajuan Kolokium</h3>
                        <table id="student" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($colloquiums as $key => $colloquium)
                                <tr>
                                   <td>{{ $key+1 }}</td>
                                   <td>{{ $colloquium->student->npm }}</td>
                                   <td>{{ $colloquium->student->user->name }}</td>
                                   <td>{{ $colloquium->date_time }}</td>
                                   <td>
                                        @if($colloquium->confirm==0)
                                        <span class="label label-warning">Menunggu Persetujuan Kaprodi</span>
                                        @else
                                        <span class="label label-info">Pengajuan Disetujui</span>
                                        @endif
                                   </td>
                                   <td>
                                        <a href="/colloquium/info/{{ $colloquium->id }}" class="waves-effect waves-light btn indigo">
                                            <i class="fas fa-info-circle"></i>
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
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-content hide-on-med-and-up">
                        <h3 class="card-title">Tabel Daftar Pengajuan Kolokium</h3>
                        <table id="student1" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($colloquiums as $key => $colloquium)
                                <tr>
                                   <td>{{ $key+1 }}</td>
                                   <td>{{ $colloquium->student->npm }}</td>
                                   <td>{{ $colloquium->student->user->name }}</td>
                                   <td>{{ $colloquium->date_time }}</td>
                                   <td>
                                        @if($colloquium->confirm==0)
                                        <span class="label label-warning">Menunggu Persetujuan Kaprodi</span>
                                        @else
                                        <span class="label label-info">Pengajuan Disetujui</span>
                                        @endif
                                   </td>
                                   <td>
                                        <a href="/colloquium/info/{{ $colloquium->id }}" class="waves-effect waves-light btn indigo">
                                            <i class="fas fa-info-circle"></i>
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
                                    <th>Tanggal</th>
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
        $('#student').DataTable();
        $('#student1').DataTable({searching: false});
    </script>
    @if (session('deleted'))
    <script>
        toastr.success('Berhasil menolak pengajuan kolokium !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
@endif
@endsection