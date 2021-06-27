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
                <a href="/super_admin/dashboard/data_overview" class="breadcrumb">Dashboard</a>
                <a href="/super_admin/dashboard/colloquium" class="breadcrumb">Daftar Pengajuan Kolokium</a>
                <a href="/colloquium/info/{{ $colloquium->id }}" class="breadcrumb">Kolokium Info</a>
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
                                    @if($colloquium->confirm==0)
                                    <a href="/colloquium/accept/{{ $colloquium->id }}" class="waves-effect waves-light btn green btn-small">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    @endif
                                    <a href="javascript:void(0);" class="waves-effect waves-light btn red btn-small deletereq1" colloquium-id="{{ $colloquium->id }}">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <a href="#modal" class="waves-effect waves-light btn indigo btn-small modal-trigger modal-edit2" colloquium-id="{{ $colloquium->id }}" time="{{ substr($colloquium->date_time,0,-3) }}">
                                        Ubah Waktu
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
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Dosen</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
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
                                    <td>
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletereq2" colloquium-id="{{ $colloquium->id }}" lecturer-id="{{ $colloquiumlecturer->lecturer->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>Belum menetapkan dosen penguji.</p>
                        @endif
                        <br>
                        {!! Form::open(['url' => '/colloquium/request/lecturer/'.$colloquium->id,'class'=>'formValidate','id'=>'formValidate']) !!}       
                            <div class="input-field col s12">
                                <i class="material-icons prefix">account_circle</i>
                                {{ Form::select('lecturer_id',$lecturers) }}
                                <label for="lecturer_id">Tambah Dosen Penguji</label>
                                <div class="errorTxt1"></div>
                            </div>  
                            <div class="form-action right-align">
                                <button class="btn cyan waves-effect waves-light submit" type="submit" name="action">Kirim</button>
                            </div>              
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div id="modal" class="modal">
                <div class="modal-content">
                <h4>Ubah Waktu Kolokium</h4>
                <p>Silakan lengkapi form dibawah ini.</p>
                {!! Form::open(['url' => '/colloquium/edit_time','class'=>'formValidate1','id'=>'formValidate1']) !!}
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">access_time</i>
                            {!! Form::text('date_time', '', ['id'=>'time_edit','placeholder'=>'','autocomplete'=>'off']) !!}
                            <label for="time_edit">Waktu</label>
                        </div>
                    </div>
                    {!! Form::hidden('id', '', ['id'=>'colloquium_id']) !!}
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
                    window.location = "/colloquium/reject/"+colloquium_id;
                }
            });
        });
        $('.deletereq2').click(function(){
            var colloquium_id = $(this).attr('colloquium-id');
            var lecturer_id = $(this).attr('lecturer-id');
            swal({   
                title: "Yakin ?",   
                text: "Batalkan penugasan dosen sebagai penguji kolokium ?",   
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
                    window.location = "/colloquium/lecturer/delete/"+colloquium_id+"/"+lecturer_id;
                }
            });
        });
        $(document).on("click", ".modal-edit2", function () {
            var id_colloquium = $(this).attr('colloquium-id');
            var time = $(this).attr('time');
            $(".modal-content #colloquium_id").val( id_colloquium );
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
        toastr.success('Berhasil menyetujui pengajuan kolokium !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
    @if (session('updated'))
    <script>
        toastr.success('Berhasil mengubah waktu kolokium !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
    @if (session('lecturerdelete'))
    <script>
        toastr.success('Berhasil membatalkan penugasan dosen penguji !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
    @if (session('fail'))
        <script>
            swal({   
                title: "Peringatan",   
                text: "Anda belum memilih dosen !",   
                type: "warning",   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Close",     
                closeOnConfirm: true,   
            });
        </script>
     @endif
    @if (session('exists'))
        <script>
            swal({   
                title: "Peringatan",   
                text: "Anda tidak dapat memilih dosen yang sama !",   
                type: "warning",   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Close",     
                closeOnConfirm: true,   
            });
        </script>
    @endif
    @if (session('added'))
        <script>
            swal({   
                title: "Success",   
                text: "Berhasil memilih dosen !",   
                type: "success",   
            });
        </script>
    @endif
@endsection