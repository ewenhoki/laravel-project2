@extends('layouts.master')

@section('header')
    <link href="{{asset('datetime/jquery.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/extra-libs/prism/prism.css')}}" rel="stylesheet">
    <title>Kolokium</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Kolokium Info</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/lecturer/dashboard/lecturer_profile" class="breadcrumb">Dashboard</a>
                <a href="/lecturer/dashboard/colloquium" class="breadcrumb">Daftar Kolokium</a>
                <a href="/colloquium/detail/{{ $colloquium->id }}" class="breadcrumb">Kolokium Info</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Pengajuan Kolokium</h3>
                        <p>Berikut adalah informasi kolokium terkait.</p>
                        <table style="width: 100%">
                            <tr>
                                <td>Nama</td>
                                <td>{{ $colloquium->student->user->name }}</td>
                            </tr>
                            <tr>
                                <td>NPM</td>
                                <td>{{ $colloquium->student->npm }}</td>
                            </tr>
                            <tr>
                                <td>Pembimbing 1</td>
                                <td>{{ $colloquium->student->lecturers()->wherePivot('order',1)->first()->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Pembimbing 2</td>
                                <td>{{ $colloquium->student->lecturers()->wherePivot('order',2)->first()->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>{{ $colloquium->date_time }}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%">Catatan</td>
                                @if($colloquium->note==NULL)
                                <td style="width: 70%">-</td>
                                @else
                                <td style="width: 70%">{{ $colloquium->note }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if($colloquium->confirm==0)
                                    <span class="label label-warning">Menunggu Persetujuan Kaprodi</span>
                                    @else
                                    <span class="label label-info">Pengajuan Disetujui</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td>
                                    @if($colloquium->colloquiumlecturers()->where('lecturer_id',auth()->user()->lecturer->id)->first()->confirm==0)
                                    <a href="/colloquium/accept_by_lecturer/{{ $colloquium->id }}" class="waves-effect waves-light btn green btn-small">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    @endif
                                    <a href="javascript:void(0);" class="waves-effect waves-light btn red btn-small deletereq1" colloquium-id="{{ $colloquium->id }}">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Dokumen Kolokium</h3>
                        @if($colloquium->colloquiumfiles()->count()!=0)
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
                                @foreach($colloquium->colloquiumfiles()->get() as $key => $file)
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
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Dosen Penguji</h3>
                        @if($colloquium->colloquiumlecturers()->count()!=0)
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Dosen</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($colloquium->colloquiumlecturers()->get() as $key => $colloquiumlecturer)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $colloquiumlecturer->lecturer->user->name }}</td>
                                    <td>
                                        @if($colloquiumlecturer->confirm==0)
                                        <span class="label label-warning">Menunggu Konfirmasi</span>
                                        @else
                                        <span class="label label-info">Dikonfirmasi</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>Belum menetapkan dosen penguji.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="{{asset('datetime/jquery.datetimepicker.full.js')}}"></script>
    <script src="{{asset('admin/assets/extra-libs/prism/prism.js')}}"></script>
    <script src="{{asset('admin/dist/js/pages/forms/jquery.validate.min.js')}}"></script>
    <script>
        $('.deletereq1').click(function(){
            var colloquium_id = $(this).attr('colloquium-id');
            swal({   
                title: "Yakin ?",   
                text: "Tolak pengajuan kolokium ? Mahasiswa harus mengajukan ulang ketika pengajuan ini dibatalkan.",   
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
                    window.location = "/colloquium/reject_by_lecturer/"+colloquium_id;
                }
            });
        });
    </script>
    @if (session('accepted'))
    <script>
        toastr.success('Berhasil menyetujui penugasan penguji kolokium !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
@endsection