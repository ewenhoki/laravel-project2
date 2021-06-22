@extends('layouts.master')

@section('header')
    <title>Seminar</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Daftar Seminar</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/lecturer/dashboard/lecturer_profile" class="breadcrumb">Dashboard</a>
                <a href="/lecturer/dashboard/seminar" class="breadcrumb">Daftar Seminar</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Tabel Daftar Seminar</h3>
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
                                @php
                                    $counter=0;
                                @endphp
                                @foreach($students as $student)
                                @if($student->seminar)
                                    @if($student->seminar->confirm==1)
                                    @php
                                        $counter++;
                                    @endphp
                                    <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ $student->npm }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->seminar->date_time }}</td>
                                    <td>
                                        @if($student->seminar->confirm==0)
                                        <span class="label label-warning">Menunggu Persetujuan Kepala Program Studi</span>
                                        @else
                                        <span class="label label-info">Pengajuan Disetujui</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/seminar/detail/{{ $student->seminar->id }}" class="waves-effect waves-light btn indigo">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </td>
                                    </tr>
                                    @endif
                                @endif
                                @endforeach
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
    </script>
@endsection