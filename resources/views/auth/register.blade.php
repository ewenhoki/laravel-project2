<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/img/logo-unpad.png')}}">
    <title>Math Unpad - Register</title>
    <link href="{{asset('admin/dist/css/style.css')}}" rel="stylesheet">
    <!-- This page CSS -->
    <link href="{{asset('admin/dist/css/pages/authentication.css')}}" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Loading...</p>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{asset('admin/assets/images/big/auth-bg5.png')}}) no-repeat left center;">
            <div class="container">
                <div class="row">
                    <div class="col s12 l8 m6 demo-text">
                        <span class="db"><img width="50" height="50" src="{{asset('admin/img/logo-unpad.png')}}" alt="logo" /></span>
                        <span class="db"><img width="155" height="25" src="{{asset('admin/img/hitam.png')}}" alt="logo" /></span>
                        <h1 class="font-light m-t-40">Selamat Datang di <br><span class="font-medium black-text"> Departemen Matematika FMIPA Unpad</span></h1>
                        <p>Silakan login untuk melakukan pengajuan tugas akhir.</p>
                        <a href="/" class="btn btn-round red m-t-5">Beranda</a>
                    </div>
                </div>
                <div class="auth-box auth-sidebar">
                    <div id="loginform">
                        <div class="p-l-10">
                            <h5 class="font-medium m-b-0 m-t-40">Daftar</h5>
                            <small>Harap lengkapi formulir di bawah ini untuk mendaftar.</small>
                        </div>
                        <br>
                        <!-- Form -->
                        <div class="row">
                            {!! Form::open(['url' => '/postregister','class'=>'sign-up-form formValidate','id'=>'formValidate']) !!}
                                <div class="row">
                                    <div class="input-field col s12">
                                        {!! Form::text('npm', old('npm'), ['id'=>'npm']) !!}
                                        @if($errors->has('npm'))
                                            <span class="help-block" style="color:red;">{{$errors->first('npm')}}</span>
                                            @php $err_reg=1 @endphp
                                        @endif
                                        <label for="npm">NPM</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        {!! Form::text('first_name', old('first_name'), ['id'=>'first_name']) !!}
                                        @if($errors->has('first_name'))
                                            <span class="help-block" style="color:red;">{{$errors->first('first_name')}}</span>
                                            @php $err_reg=1 @endphp
                                        @endif
                                        <label for="first_name">Nama Depan</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        {!! Form::text('last_name', old('last_name'), ['id'=>'last_name']) !!}
                                        <label for="last_name">Nama Belakang</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        {!! Form::number('gpa', old('gpa'), ['id'=>'gpa','step'=>'0.01']) !!}
                                        @if($errors->has('gpa'))
                                            <span class="help-block" style="color:red;">{{$errors->first('gpa')}}</span>
                                            @php $err_reg=1 @endphp
                                        @endif
                                        <label for="gpa">IPK</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        {!! Form::text('phone', old('phone'), ['id'=>'phone']) !!}
                                        @if($errors->has('phone'))
                                            <span class="help-block" style="color:red;">{{$errors->first('phone')}}</span>
                                            @php $err_reg=1 @endphp
                                        @endif
                                        <label for="phone">Nomor Telepon</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        {!! Form::email('email',old('email'), ['id'=>'email']) !!}
                                        @if($errors->has('email'))
                                            <span class="help-block" style="color:red;">{{$errors->first('email')}}</span>
                                            @php $err_reg=1 @endphp
                                        @endif
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        {!! Form::password('password', ['id'=>'password']) !!}
                                        @if($errors->has('password'))
                                            <span class="help-block" style="color:red;">{{$errors->first('password')}}</span>
                                            @php $err_reg=1 @endphp
                                        @endif
                                        <label for="password">Kata Sandi</label>
                                    </div>
                                </div>
                                <div class="row m-t-5">
                                    <div class="col s7">
                                        <label>
                                            <input type="checkbox" onclick="myFunction()">
                                            <span>Lihat Kata Sandi</span>
                                        </label>
                                    </div>
                                </div>
                                <!-- pwd -->
                                <div class="row m-t-40">
                                    <div class="col s12">
                                        <button class="btn-large w100 red" type="submit">Daftar</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="center-align m-t-20 db">
                            Sudah punya akun ? <a href="/login">Login di sini !</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{asset('admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('admin/dist/js/materialize.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script src="{{asset('admin/dist/js/pages/forms/jquery.validate.min.js')}}"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        $(function() {
            $("#formValidate").validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 3,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 12,
                        number: true,
                    },
                    npm: {
                        required: true,
                        minlength: 12,
                        maxlength: 12,
                        number: true,
                    },
                    gpa: {
                        required: true,
                        min: 1,
                        max: 4,
                    },
                    password: {
                        required: true,
                        minlength: 8,
                    }
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
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
    </script>
</body>

</html>