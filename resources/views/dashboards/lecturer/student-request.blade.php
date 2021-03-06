@extends('layouts.master')

@section('header')
    <title>Pengajuan oleh Mahasiswa</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Daftar Pengajuan oleh Mahasiswa</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/lecturer/dashboard/lecturer_profile" class="breadcrumb">Dashboard</a>
                <a href="/lecturer/dashboard/student_request" class="breadcrumb">Daftar Pengajuan oleh Mahasiswa</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content hide-on-small-only">
                        <h3 class="card-title">Tabel Daftar Pengajuan oleh Mahasiswa</h3>
                        <table id="student" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Pembimbing ke-</th>
                                    <th>Status</th>
                                    <th>Judul</th>
                                    <th>Dokumen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $key => $student)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $student->npm }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->lecturers()->where('lecturers.id',auth()->user()->lecturer->id)->first()->pivot->order }}</td>
                                    <td><i class="fa fa-circle {{ $tooltip[$student->lecturers()->where('lecturers.id',auth()->user()->lecturer->id)->first()->pivot->progress-1] }}-text tooltipped" data-tooltip="{{ $status[$student->lecturers()->where('lecturers.id',auth()->user()->lecturer->id)->first()->pivot->progress-1] }}"></i></td>
                                    <td>{{ $student->file->title }}</td>
                                    <td>
                                        <a href="/lecturer/letter_1/export/{{ $student->id }}" class="waves-effect waves-light btn pink darken-3" target="_blank">Persetujuan</a>
                                        <a href="{{ $student->file->krs }}" class="waves-effect waves-light btn deep-purple darken-3" target="_blank">KRS</a>
                                        <a href="{{ $student->file->kss }}" class="waves-effect waves-light btn indigo indigo darken-1" target="_blank">KSS</a>
                                        <a href="{{ $student->file->proposal }}" class="waves-effect waves-light btn blue darken-2" target="_blank">Proposal</a>
                                        <a href="{{ $student->file->paper }}" class="waves-effect waves-light btn light-blue darken-1" target="_blank">Paper</a>
                                        @if($student->file->letter_2 != NULL)
                                        <a href="{{ $student->file->letter_2 }}" class="waves-effect waves-light btn cyan darken-1" target="_blank">S. Tugas</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($student->lecturers()->where('lecturers.id',auth()->user()->lecturer->id)->first()->pivot->progress==1)
                                        <a href="/request/accept_by_lecturer/{{ $student->id }}" class="waves-effect waves-light btn green">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        @endif
                                        @if($student->lecturers()->where('lecturers.id',auth()->user()->lecturer->id)->first()->pivot->progress==3)
                                        <a href="#modal1" class="waves-effect waves-light btn blue modal-trigger modal-edit" student-id="{{ $student->id }}" student-name="{{ $student->user->name }}">
                                            <i class="fas fa-flag-checkered"></i>
                                        </a>
                                        @endif
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletereq1" student-id="{{ $student->id }}" student-name="{{ $student->user->name }}">
                                            <i class="fas fa-times"></i>
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
                                    <th>Pembimbing ke-</th>
                                    <th>Status</th>
                                    <th>Judul</th>
                                    <th>Dokumen</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-content hide-on-med-and-up">
                        <h3 class="card-title">Tabel Daftar Pengajuan oleh Mahasiswa</h3>
                        <table id="student1" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Pembimbing ke-</th>
                                    <th>Status</th>
                                    <th>Judul</th>
                                    <th>Dokumen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $key => $student)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $student->npm }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->lecturers()->where('lecturers.id',auth()->user()->lecturer->id)->first()->pivot->order }}</td>
                                    <td><i class="fa fa-circle {{ $tooltip[$student->lecturers()->where('lecturers.id',auth()->user()->lecturer->id)->first()->pivot->progress-1] }}-text tooltipped" data-tooltip="{{ $status[$student->lecturers()->where('lecturers.id',auth()->user()->lecturer->id)->first()->pivot->progress-1] }}"></i></td>
                                    <td>{{ $student->file->title }}</td>
                                    <td>
                                        <a href="/lecturer/letter_1/export/{{ $student->id }}" class="waves-effect waves-light btn pink darken-3" target="_blank">Persetujuan</a>
                                        <a href="{{ $student->file->krs }}" class="waves-effect waves-light btn deep-purple darken-3" target="_blank">KRS</a>
                                        <a href="{{ $student->file->kss }}" class="waves-effect waves-light btn indigo indigo darken-1" target="_blank">KSS</a>
                                        <a href="{{ $student->file->proposal }}" class="waves-effect waves-light btn blue darken-2" target="_blank">Proposal</a>
                                        <a href="{{ $student->file->paper }}" class="waves-effect waves-light btn light-blue darken-1" target="_blank">Paper</a>
                                        @if($student->file->letter_2 != NULL)
                                        <a href="{{ $student->file->letter_2 }}" class="waves-effect waves-light btn cyan darken-1" target="_blank">S. Tugas</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($student->lecturers()->where('lecturers.id',auth()->user()->lecturer->id)->first()->pivot->progress==1)
                                        <a href="/request/accept_by_lecturer/{{ $student->id }}" class="waves-effect waves-light btn green">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        @endif
                                        @if($student->lecturers()->where('lecturers.id',auth()->user()->lecturer->id)->first()->pivot->progress==3)
                                        <a href="#modal1" class="waves-effect waves-light btn blue modal-trigger modal-edit" student-id="{{ $student->id }}" student-name="{{ $student->user->name }}">
                                            <i class="fas fa-flag-checkered"></i>
                                        </a>
                                        @endif
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletereq1" student-id="{{ $student->id }}" student-name="{{ $student->user->name }}">
                                            <i class="fas fa-times"></i>
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
                                    <th>Pembimbing ke-</th>
                                    <th>Status</th>
                                    <th>Judul</th>
                                    <th>Dokumen</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <h4>Selesai Bimbingan</h4>
                            <p>Jika mahasiswa sudah dinyatakan menyelesaikan bimbingan, Anda tidak dapat melakukan perubahan terhadap absensi bimbingan yang sudah ada.</p>
                            {!! Form::open(['url' => '/lecturer/finish']) !!}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        {!! Form::text('name', '', ['placeholder'=>'Nama Mahasiswa','id'=>'student_name','readonly']) !!}
                                        <label for="student_name">Nama Mahasiswa</label>
                                    </div>
                                </div>
                                <h5 class="center">Salin kata dibawah ini untuk melakukan konfirmasi.</h5>
                                <h5 class="center">Dengan ini saya menyatakan bahwa mahasiswa terkait telah menyelesaikan masa bimbingannya.</h5>
                                <div class="row">
                                    <div class="input-field col s12">
                                        {!! Form::text('confirm', '', ['id'=>'confirm']) !!}
                                        <label for="confirm">Ketik di sini.</label>
                                    </div>
                                </div>
                                {!! Form::hidden('id', '', ['id'=>'student_id']) !!}
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
    </div>
</div>
@endsection

@section('footer')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    {{-- <script src="{{asset('admin/dist/js/pages/datatable/datatable-basic.init.js')}}"></script> --}}
    <script>
        $(document).on("click", ".modal-edit", function () {
            var id = $(this).attr('student-id');
            var name = $(this).attr('student-name');
            $(".modal-content #student_id").val( id );
            $(".modal-content #student_name").val( name ); 
        });
        $('.deletereq1').click(function(){
            var student_id = $(this).attr('student-id');
            var student_name = $(this).attr('student-name');
            swal({   
                title: "Yakin ?",   
                text: "Tolak pengajuan dosen pembimbing untuk mahasiswa bernama "+student_name+"?",   
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
                    window.location = "/request/reject_by_lecturer/"+student_id;
                }
            });
        });
        $('#student').DataTable();
        $('#student1').DataTable({searching: false});
    </script>
    @if (session('accepted'))
        <script>
            toastr.success('Berhasil menyetujui pengajuan dosen pembimbing !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
    @if (session('rejected'))
    <script>
        toastr.success('Berhasil menolak pengajuan dosen pembimbing !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
    @if (session('rejected'))
    <script>
        toastr.success('Berhasil menyelesaikan status bimbingan mahasiswa !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
    </script>
    @endif
    @if (session('wrong'))
    <script>
        swal({   
            title: "Peringatan",   
            text: "Kalimat konfirmasi yang anda masukkan salah !",   
            type: "warning",   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Close",     
            closeOnConfirm: true,   
        });
    </script>
    @endif
@endsection