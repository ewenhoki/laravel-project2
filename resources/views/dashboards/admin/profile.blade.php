@extends('layouts.master')

@section('header')
    <title>Profil</title>
@endsection

@section('content')
<div class="page-wrapper page-header">
    <div class="card danger-gradient m-t-0 m-b-0">
        <div class="card-content">
            <div class="p-b-40 p-t-20">
                <h3 class="white-text">Selamat Datang {{ auth()->user()->name }} !</h3>
                <p class="white-text op-7 m-b-20">Scroll ke bawah untuk melihat informasi user.</p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12 m4">
                <div class="card">
                    <img class="responsive-img" src="{{ asset('admin/assets/images/big/socialbg.jpg')}}" height="456" alt="Card image">
                    <div class="card-img-overlay white-text social-profile d-flex justify-content-center">
                        <div class="align-self-center">
                            @if(auth()->user()->avatar!=NULL)
                                @if(file_exists(public_path(auth()->user()->avatar)))
                                <img src="{{ auth()->user()->avatar }}" class="circle" width="100" height="100">
                                @else
                                <img src="{{ asset('admin/img/profile-default.png')}}" class="circle" width="100">
                                @endif
                            @else
                            <img src="{{ asset('admin/img/profile-default.png')}}" class="circle" width="100">
                            @endif
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
                        <small>Nama </small>
                        <h6>{{ auth()->user()->name }}</h6>
                    </div>
                </div>
            </div>
            <div class="col s12 m8">
                <div class="card">
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s3"><a class="active" href="#settings">Pengaturan</a></li>
                            </ul>
                        </div> 
                        <div id="settings" class="col s12">
                            <div class="card-content">
                                {!! Form::open(['url' => '/postadminliteprofile','class'=>'formValidate','id'=>'formValidate']) !!}                 
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {!! Form::text('name', auth()->user()->name, ['placeholder'=>'Nama']) !!}
                                            <label for="name">Nama</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {!! Form::text('phone', auth()->user()->phone, ['placeholder'=>'Nomor Telepon']) !!}
                                            <label for="phone">Nomor Telepon</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col s12">Foto Profil</label>
                                        <div class="file-field input-field col s12">
                                            <div>
                                                <a class="btn blue darken-1" id="fm-1" data-input="avatar" data-preview="holder">Upload & Crop</a>
                                            </div>
                                            <div class="file-path-wrapper">
                                                {!! Form::text('avatar',auth()->user()->avatar, ['placeholder'=>'Foto Profil','id'=>'avatar','class'=>'form-control','readonly']) !!}
                                            </div>
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
                                    <div id="modal1" class="modal">
                                        <div class="modal-content">
                                            <h4>Masukan Kata Sandi</h4>
                                            <p>Masukan kata sandi untuk melakukan perubahan profil.</p>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    {!! Form::password('password_old') !!}
                                                    <label for="password_old">Kata Sandi</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-red btn-flat ">Tutup</a>
                                            <button class="modal-action modal-close waves-effect waves-red btn-flat" type="submit" name="action">Kirim</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <a href="#modal1" class="btn teal waves-effect waves-light modal-trigger modal-edit">
                                                Perbaharui Profil
                                            </a>
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
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script>
        $(function() {
            $("#formValidate").validate({
                rules: {
                    name: {
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
        $('#fm-1').filemanager('file');
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