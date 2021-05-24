<!DOCTYPE html>
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
</html>
