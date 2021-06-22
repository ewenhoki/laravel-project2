@extends('layouts.master')

@section('header')
    <link href="{{asset('datetime/jquery.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/extra-libs/prism/prism.css')}}" rel="stylesheet">
    <title>Seminar</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Seminar Info</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/super_admin/dashboard/data_overview" class="breadcrumb">Dashboard</a>
                <a href="/super_admin/dashboard/seminar" class="breadcrumb">Seminar</a>
                <a href="/seminar/info/{{ $seminar->id }}" class="breadcrumb">Seminar Info</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s6">
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
                                    <span class="label label-warning">Menunggu Persetujuan Kepala Program Studi</span>
                                    @else
                                    <span class="label label-info">Pengajuan Disetujui</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td>
                                    @if($seminar->confirm==0)
                                    <a href="/seminar/accept/{{ $seminar->id }}" class="waves-effect waves-light btn green btn-small">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    @endif
                                    <a href="javascript:void(0);" class="waves-effect waves-light btn red btn-small deletereq1" seminar-id="{{ $seminar->id }}">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <a href="#modal" class="waves-effect waves-light btn indigo btn-small modal-trigger modal-edit2" seminar-id="{{ $seminar->id }}" time="{{ substr($seminar->date_time,0,-3) }}">
                                        Ubah Waktu
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col s6">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">Dokumen Seminar</h3>
                        @if($seminar->seminarfiles()->count()!=0)
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Upload</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seminar->seminarfiles()->get() as $key => $file)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $file->created_at }}</td>
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
            <div id="modal" class="modal">
                <div class="modal-content">
                <h4>Ubah Waktu Seminar</h4>
                <p>Silakan lengkapi form dibawah ini.</p>
                {!! Form::open(['url' => '/seminar/edit_time','class'=>'formValidate1','id'=>'formValidate1']) !!}
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">access_time</i>
                            {!! Form::text('date_time', '', ['id'=>'time_edit','placeholder'=>'','autocomplete'=>'off']) !!}
                            <label for="time_edit">Waktu</label>
                        </div>
                    </div>
                    {!! Form::hidden('id', '', ['id'=>'seminar_id']) !!}
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-red btn-flat ">Tutup</a>
                    <button class="modal-action modal-close waves-effect waves-red btn-flat" type="submit" name="action">Kirim</button>
                </div>
                {!! Form::close() !!}                
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
            var seminar_id = $(this).attr('seminar-id');
            swal({   
                title: "Yakin ?",   
                text: "Tolak pengajuan seminar ? Mahasiswa harus mengajukan ulang ketika pengajuan ini dibatalkan.",   
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
                    window.location = "/seminar/reject/"+seminar_id;
                }
            });
        });
        $(document).on("click", ".modal-edit2", function () {
            var id_seminar = $(this).attr('seminar-id');
            var time = $(this).attr('time');
            $(".modal-content #seminar_id").val( id_seminar );
            $(".modal-content #time_edit").val( time );
        });
        $(document).ready(function(){
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today =  yyyy + '-' + mm + '-' + dd;
            jQuery.datetimepicker.setLocale('id')
            $('#time_edit').datetimepicker({
                timepicker: true,
                datepicker: true,
                format: 'Y-m-d H:i',
                hours12: false,
                step: 15,
                lang: 'id',
            });
        });
    </script>
    @if (session('accepted'))
    <script>
        toastr.success('Berhasil menyetujui pengajuan seminar !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
    @if (session('updated'))
    <script>
        toastr.success('Berhasil mengubah waktu seminar !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
@endsection