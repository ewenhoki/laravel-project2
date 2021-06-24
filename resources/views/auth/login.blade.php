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