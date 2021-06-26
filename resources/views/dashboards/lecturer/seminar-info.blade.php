@extends('layouts.master')

@section('header')
    <title>Seminar</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Seminar Info</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/lecturer/dashboard/lecturer_profile" class="breadcrumb">Dashboard</a>
                <a href="/lecturer/dashboard/seminar" class="breadcrumb">Daftar Seminar</a>
                <a href="/seminar/detail/{{ $seminar->id }}" class="breadcrumb">Seminar Info</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Pengajuan Seminar</h3>
                        <p>Berikut adalah informasi seminar terkait.</p>
                        <table style="width: 100%">
                            <tr>
                                <td>Nama</td>
                                <td>{{ $seminar->student->user->name }}</td>
                            </tr>
                            <tr>
                                <td>NPM</td>
                                <td>{{ $seminar->student->npm }}</td>
                            </tr>
                            <tr>
                                <td>Pembimbing 1</td>
                                <td>{{ $seminar->student->lecturers()->wherePivot('order',1)->first()->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Pembimbing 2</td>
                                <td>{{ $seminar->student->lecturers()->wherePivot('order',2)->first()->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>{{ $seminar->date_time }}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%">Catatan</td>
                                @if($seminar->note==NULL)
                                <td style="width: 70%">-</td>
                                @else
                                <td style="width: 70%">{{ $seminar->note }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if($seminar->confirm==0)
                                    <span class="label label-warning">Menunggu Persetujuan Kaprodi</span>
                                    @else
                                    <span class="label label-info">Pengajuan Disetujui</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Dokumen Seminar</h3>
                        @if($seminar->seminarfiles()->count()!=0)
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Upload</th>
                                    <th>Nama File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seminar->seminarfiles()->get() as $key => $file)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $file->created_at }}</td>
                                    <td>
                                        @php
                                            $file->file;
                                            $count = strlen($file->file)-1;
                                            $buffer = '';
                                            for($i=$count; $i>0; $i--){
                                                if($file->file[$i]=="/"){
                                                    break;
                                                }
                                                else{
                                                    $buffer = $file->file[$i].$buffer;
                                                }
                                            }
                                        @endphp
                                        {{ $buffer }}
                                    </td>
                                    <td>
                                        <a href="{{ $file->file }}" class="waves-effect waves-light btn deep-purple darken-3" target="_blank">Download</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>Belum melakukan upload dokumen.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@endsection