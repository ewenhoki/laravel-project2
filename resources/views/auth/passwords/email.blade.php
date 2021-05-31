{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/img/logo-unpad.png')}}">
    <title>Pemulihan Kata Sandi</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('admin/assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/dist/css/style.css')}}" rel="stylesheet">
    <!-- This page CSS -->
    <link href="{{asset('admin/dist/css/pages/error-pages.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <section id="wrapper" class="error-page">
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Loading...</p>
            </div>
        </div>
        <div class="error-box" style="background:url({{asset('admin/assets/images/big/auth-bg.jpg')}}) no-repeat center center;">
            <div class="error-body center-align">
                <div class="card" style="width: 30%;margin: 0 auto;">
                    <div class="card-content">
                        <img width=45 height=45 src="{{asset('admin/img/logo-unpad.png')}}">
                        <h6>Pemulihan Kata Sandi</h6>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="input-field">
                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button  type="submit" class="waves-effect waves-light btn indigo">{{ __('Kirim Link Reset Kata Sandi') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{asset('admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('admin/dist/js/materialize.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/toastr/build/toastr.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('admin/dist/js/custom.min.js')}}"></script>
    @if (session('status'))
        <script>toastr.success('{{ session('status') }}','Email terkirim !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });</script>
    @endif
</body>

</html>