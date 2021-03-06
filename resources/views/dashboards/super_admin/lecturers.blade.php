@extends('layouts.master')

@section('header')
    <title>Dosen</title>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h5 class="font-medium m-b-0">Pengelolaan Dosen</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="/super_admin/dashboard/data_overview" class="breadcrumb">Dashboard</a>
                <a href="/super_admin/dashboard/lecturers" class="breadcrumb">Pengelolaan Dosen</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content hide-on-small-only">
                        <div class="row">
                            <h3 class="card-title col s6">Tabel Dosen</h3>
                            <div class="col s6">
                                <a href="/lectureruser/add" class="right waves-effect waves-light btn indigo">Tambah Dosen</a>
                            </div>
                        </div>
                        <table id="lecturer" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIP</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Nomor Telepon</th>
                                    <th>Jumlah Mahasiswa (1)</th>
                                    <th>Jumlah Mahasiswa (2)</th>
                                    <th>Slot</th>
                                    <th>Aksi</th>
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
                                    <td>{{ $lecturer->students()->wherePivot('order',1)->count() }}</td>
                                    <td>{{ $lecturer->students()->wherePivot('order',2)->count() }}</td>
                                    <td>{{ $lecturer->slot }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletelecturer" lecturer-id="{{ $lecturer->id }}" lecturer-name="{{ $lecturer->user->name }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <a href="#modal1" class="waves-effect waves-light btn blue modal-trigger modal-edit" lecturer-id="{{ $lecturer->id }}" lecturer-name="{{ $lecturer->user->name }}" lecturer-slot="{{ $lecturer->slot }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>NIP</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Nomor Telepon</th>
                                    <th>Jumlah Mahasiswa (1)</th>
                                    <th>Jumlah Mahasiswa (2)</th>
                                    <th>Slot</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                        {{-- <div id="modal1" class="modal">
                            <div class="modal-content">
                                <h4>Ubah Jumlah Slot Tersedia</h4>
                                <p>Ubah slot pembimbing 1 yang tersedia untuk dosen terkait.</p>
                                {!! Form::open(['url' => '/slot/update']) !!}
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">account_circle</i>
                                            {!! Form::text('name', '', ['placeholder'=>'Nama Dosen','id'=>'lecturer_name','readonly']) !!}
                                        
                                            <label for="lecturer_name">Nama Dosen</label>
                                        </div>
                                    </div>
                            
                                    {!! Form::hidden('id', '', ['id'=>'lecturer_id']) !!}
                                    <p>Geser Slider untuk Merubah Jumlah Slot Tersedia</p>
                                    <p class="range-field">
                                        {!! Form::range('slot', '', ['id'=>'slot','min'=>'0','max'=>'10']) !!}
                            
                                    </p>          
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-red btn-flat ">Tutup</a>
                                    <button class="modal-action modal-close waves-effect waves-red btn-flat" type="submit" name="action">Kirim</button>
                                </div>
                                {!! Form::close() !!}                
                        </div> --}}
                    </div>
                    <div class="card-content hide-on-med-and-up">
                        <div class="row">
                            <h3 class="card-title col s6">Tabel Dosen</h3>
                            <div class="col s6">
                                <a href="/lectureruser/add" class="right waves-effect waves-light btn indigo">Tambah Dosen</a>
                            </div>
                        </div>
                        <table id="lecturer1" class="responsive-table highlight display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIP</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Nomor Telepon</th>
                                    <th>Jumlah Mahasiswa (1)</th>
                                    <th>Jumlah Mahasiswa (2)</th>
                                    <th>Slot</th>
                                    <th>Aksi</th>
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
                                    <td>{{ $lecturer->students()->wherePivot('order',1)->count() }}</td>
                                    <td>{{ $lecturer->students()->wherePivot('order',2)->count() }}</td>
                                    <td>{{ $lecturer->slot }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn red deletelecturer" lecturer-id="{{ $lecturer->id }}" lecturer-name="{{ $lecturer->user->name }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <a href="#modal1" class="waves-effect waves-light btn blue modal-trigger modal-edit" lecturer-id="{{ $lecturer->id }}" lecturer-name="{{ $lecturer->user->name }}" lecturer-slot="{{ $lecturer->slot }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="hide-on-small-only">
                                <tr>
                                    <th>#</th>
                                    <th>NIP</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Nomor Telepon</th>
                                    <th>Jumlah Mahasiswa (1)</th>
                                    <th>Jumlah Mahasiswa (2)</th>
                                    <th>Slot</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <h4>Ubah Jumlah Slot Tersedia</h4>
                            <p>Ubah slot pembimbing 1 yang tersedia untuk dosen terkait.</p>
                            {!! Form::open(['url' => '/slot/update']) !!}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        {!! Form::text('name', '', ['placeholder'=>'Nama Dosen','id'=>'lecturer_name','readonly']) !!}
                                        {{-- <input id="lecturer_name" type="text" value="" placeholder="Nama Dosen" readonly> --}}
                                        <label for="lecturer_name">Nama Dosen</label>
                                    </div>
                                </div>
                                {{-- <input id="lecturer_id" type="hidden" value=""/> --}}
                                {!! Form::hidden('id', '', ['id'=>'lecturer_id']) !!}
                                <p>Geser Slider untuk Merubah Jumlah Slot Tersedia</p>
                                <p class="range-field">
                                    {!! Form::range('slot', '', ['id'=>'slot','min'=>'0','max'=>'10']) !!}
                                    {{-- <input type="range" id="slot" name="slot" min="0" max="10" value=""/> --}}
                                </p>          
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
        $('.deletelecturer').click(function(){
            var lecturer_id = $(this).attr('lecturer-id');
            var lecturer_name = $(this).attr('lecturer-name');
            swal({   
                title: "Yakin ?",   
                text: "Hapus dosen dengan nama "+lecturer_name+"?",   
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
                    window.location = "/lecturers/delete/"+lecturer_id;
                }
            });
        });
        $(document).on("click", ".modal-edit", function () {
            var slot = $(this).attr('lecturer-slot');
            var id = $(this).attr('lecturer-id');
            var name = $(this).attr('lecturer-name');
            $(".modal-content #slot").val( slot );
            $(".modal-content #lecturer_id").val( id );
            $(".modal-content #lecturer_name").val( name ); 
        });
        $('#lecturer').DataTable();
        $('#lecturer1').DataTable({searching: false});
    </script>
    @if (session('success'))
        <script>
            toastr.success('Hapus Dosen Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
    @if (session('created'))
        <script>
            toastr.success('Tambah User Dosen Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
    @if (session('edited'))
        <script>
            toastr.success('Ubah Jumlah Slot Berhasil !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
        </script>
    @endif
@endsection