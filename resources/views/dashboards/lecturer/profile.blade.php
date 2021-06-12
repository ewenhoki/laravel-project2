@extends('layouts.master')

@section('header')
    <title>Profil</title>
@endsection

@section('content')
<div class="page-wrapper page-header">
    <!-- ============================================================== -->
    <!-- Title and breadcrumb -->
    <!-- ============================================================== -->
    <div class="card success-gradient m-t-0 m-b-0">
        <div class="card-content">
            <div class="p-b-40 p-t-20">
                <h3 class="white-text">Selamat Datang {{ auth()->user()->name }} !</h3>
                <p class="white-text op-7 m-b-20">Scroll ke bawah untuk melihat informasi user.</p>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Container fluid scss in scafholding.scss -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row">
            <div class="col s4">
                <div class="card">
                    <img class="responsive-img" src="{{ asset('admin/assets/images/big/socialbg.jpg')}}" height="456" alt="Card image">
                    <div class="card-img-overlay white-text social-profile d-flex justify-content-center">
                        <div class="align-self-center">
                            <img src="{{ asset('admin/img/profile-default.png')}}" class="circle" width="100">
                            <h4 class="card-title white-text">{{ auth()->user()->name }}</h4>
                            <h6 class="card-subtitle">{{ auth()->user()->role }}</h6>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <small>Email </small>
                        <h6>{{ auth()->user()->email }}</h6>
                        <small>Nomor Telepon </small>
                        <h6>{{ auth()->user()->phone }}</h6>
                        <small>NIP</small>
                        <h6>{{ $lecturer->nip }}</h6>
                        <small>Nama Depan</small>
                        <h6>{{ $lecturer->first_name }}</h6>
                        <small>Nama Belakang</small>
                        <h6>{{ $lecturer->last_name }}</h6>
                        <small>Jumlah Mahasiswa yang Dibimbing</small>
                        <h6>{{ $lecturer->students()->wherePivot('progress','>=',3)->count() }}</h6>
                        <small>Jumlah Mahasiswa dalam Proses Pengajuan</small>
                        <h6>{{ $lecturer->students()->wherePivot('progress','<',3)->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col s8">
                <div class="card">
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s3"><a class="active" href="#settings">Pengaturan</a></li>
                            </ul>
                        </div>
                        <div id="settings" class="col s12">
                            <div class="card-content">
                                {!! Form::open(['url' => '/postlecturerprofile','class'=>'formValidate','id'=>'formValidate']) !!}  
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {!! Form::text('first_name', auth()->user()->lecturer->first_name, ['placeholder'=>'Nama Depan']) !!}
                                            <label for="first_name">Nama Depan</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {!! Form::text('last_name', auth()->user()->lecturer->last_name, ['placeholder'=>'Nama Belakang']) !!}
                                            <label for="last_name">Nama Belakang</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {!! Form::text('phone', auth()->user()->phone, ['placeholder'=>'Nomor Telepon']) !!}
                                            <label for="phone">Nomor Telepon</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {!! Form::password('password',['placeholder'=>'Kata Sandi Baru','id'=>'password']) !!}
                                            <label for="password">Ganti Kata Sandi</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {!! Form::password('password_confirm',['placeholder'=>'Konfirmasi Kata Sandi Baru']) !!}
                                            <label for="password_confirm">Konfirmasi Kata Sandi Baru</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {!! Form::password('password_old',['placeholder'=>'Kata Sandi Saat Ini']) !!}
                                            <label for="password_old">Kata Sandi</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn teal waves-effect waves-light" type="submit" name="action">Perbaharui Profil</button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Container fluid scss in scafholding.scss -->
    <!-- ============================================================== -->
</div>
@endsection

@section('footer')
    <script src="{{asset('admin/dist/js/pages/forms/jquery.validate.min.js')}}"></script>
    <script>
        $(function() {
            $("#formValidate").validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 3,
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 12,
                        number: true,
                    },
                    password: {
                        minlength: 8,
                    },
                    password_confirm: {
                        minlength: 8,
                        equalTo : "#password",
                    },
                    password_old: {
                        required: true,
                    },
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                },
                invalidHandler: function(e, validator) {
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                        $('.error-alert-bar').show();
                    }
                },
            });
        });
    </script>
    @if (session('updated'))
     <script>
         toastr.success('Akun berhasil diperbaharui !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });
     </script>
    @endif
    @if(session('fail'))
        <script>
            swal("Gagal Perbaharui Data !", "Kata sandi tidak cocok.", "error");
        </script>
    @endif
@endsection