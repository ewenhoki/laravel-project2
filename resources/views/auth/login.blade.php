{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('asset_login/style.css')}}" />
    <link rel="shortcut icon" type="image/png" sizes="96x96" href="{{asset('admin/img/logo-unpad.png')}}"/>
    <title>Math Unpad - Sign in & Sign up</title>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                {!! Form::open(['url' => '/postlogin','class'=>'sign-in-form']) !!}
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        {!! Form::email('email','', ['placeholder'=>'Email']) !!}
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        {!! Form::password('password', ['placeholder'=>'Password']) !!}
                    </div>
                        <input type="submit" value="Login" class="btn solid" />
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                {!! Form::close() !!}
                {!! Form::open(['url' => '/postregister','class'=>'sign-up-form']) !!}
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-clipboard"></i>
                        {!! Form::text('npm', old('npm'), ['placeholder'=>'NPM']) !!}
                    </div>
                    @if($errors->has('npm'))
                        <span class="help-block" style="color:red;">{{$errors->first('npm')}}</span>
                        @php $err_reg=1 @endphp
                    @endif
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        {!! Form::text('first_name', old('first_name'), ['placeholder'=>'First Name']) !!}
                    </div>
                    @if($errors->has('first_name'))
                        <span class="help-block" style="color:red;">{{$errors->first('first_name')}}</span>
                        @php $err_reg=1 @endphp
                    @endif
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        {!! Form::text('last_name', old('last_name'), ['placeholder'=>'Last Name']) !!}
                    </div>
                    <div class="input-field"> 
                        <i class="fas fa-university"></i>
                        {!! Form::number('gpa', old('gpa'), ['placeholder'=>'GPA','step'=>'0.01']) !!}
                    </div>
                    @if($errors->has('gpa'))
                        <span class="help-block" style="color:red;">{{$errors->first('gpa')}}</span>
                        @php $err_reg=1 @endphp
                    @endif
                    <div class="input-field"> 
                        <i class="fas fa-phone"></i>
                        {!! Form::text('phone', old('phone'), ['placeholder'=>'Phone']) !!}
                    </div>
                    @if($errors->has('phone'))
                        <span class="help-block" style="color:red;">{{$errors->first('phone')}}</span>
                        @php $err_reg=1 @endphp
                    @endif
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        {!! Form::email('email',old('email'), ['placeholder'=>'Email']) !!}
                    </div>
                    @if($errors->has('email'))
                        <span class="help-block" style="color:red;">{{$errors->first('email')}}</span>
                        @php $err_reg=1 @endphp
                    @endif
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        {!! Form::password('password', ['placeholder'=>'Password']) !!}
                    </div>
                    @if($errors->has('password'))
                        <span class="help-block" style="color:red;">{{$errors->first('password')}}</span>
                        @php $err_reg=1 @endphp
                    @endif
                    <input type="submit" class="btn" value="Sign up" />
                {!! Form::close() !!}
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        Not registered yet ? Join now by click the Sign Up button and fill the registration form !
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="{{asset('asset_login/img/Team.png')}}" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>
                        Already have an account ? Please click the Sign In button to go to the Sign In page.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="{{asset('asset_login/img/Online-Education.png')}}" class="image" alt="" />
            </div>
        </div>
    </div>
    <script src="{{asset('asset_login/app.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if(session('berhasil'))
        <script>
            swal("Registration Success !", "Thank you for registering in our website !", "success");
        </script>
    @endif
    @if(session('gagal'))
        <script>
            swal("Login Failed !", "Email and Password did not match.", "error");
        </script>
    @endif
    @if(isset($err_reg))
        <script>
            swal("Register Failed !", "Please check the required form.", "error");
        </script>
    @endif
</body>
</html> --}}

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Unpad - Login</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/img/logo-unpad.png')}}">
    <link href="{{asset('admin/assets/libs/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/dist/css/style.css')}}" rel="stylesheet">
    <!-- This page CSS -->
    <link href="{{asset('admin/dist/css/pages/authentication.css')}}" rel="stylesheet">
    <!-- This page CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
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
                            <h5 class="font-medium m-b-0 m-t-40">Sign In</h5>
                            <small>Masukan email dan kata sandi untuk login.</small>
                        </div>
                        <br>
                        <!-- Form -->
                        <div class="row">
                            {!! Form::open(['url' => '/postlogin','class'=>'col s12']) !!}
                                <div class="row">
                                    <div class="input-field col s12">
                                        {!! Form::email('email','', ['class'=>'validate','required','id'=>'email']) !!}
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        {!! Form::password('password', ['class'=>'validate','required','id'=>'password']) !!}
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
                                    <div class="col s5 right-align"><a href="{{ route('password.request') }}">{{ __('Lupa Kata Sandi ?') }}</a></div>
                                </div>
                                <div class="row m-t-40">
                                    <div class="col s12">
                                        <button class="btn-large w100 blue accent-4" type="submit">Login</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="center-align m-t-20 db">
                            Belum punya akun ? <a href="/register">Daftar di sini !</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{asset('admin/assets/libs/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('admin/dist/js/materialize.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $(function() {
        $(".preloader").fadeOut();
    });
    </script>
    @if(session('berhasil'))
        <script>
            swal("Registrasi Berhasil !", "Terima kasih telah mendaftar.", "success");
        </script>
    @endif
    @if(session('gagal'))
        <script>
            swal("Login Gagal !", "Email and kata sandi tidak cocok.", "error");
        </script>
    @endif
    </body>

</html>