{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.master')

@section('header')
    <title>Email Verification</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('admin/assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title">{{ __('Verifikasi Alamat Email Anda') }}</h3>
                        <div class>
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                                </div>
                            @endif
                            <p>
                            {{ __('Sebelum melanjutkan, silakan klik tombol di bawah dan periksa email Anda untuk link verifikasi.') }}
                            {{ __('Jika Anda tidak menerima email') }}, coba tekan tombol di bawah lagi.
                            </p>
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="waves-effect waves-light btn blue">{{ __('Klik di sini untuk meminta verifikasi email') }}</button>.
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="{{asset('admin/assets/libs/toastr/build/toastr.min.js')}}"></script>
    @if (session('resent'))
        <script>toastr.success('Link verifikasi baru telah dikirim ke alamat email Anda.','Email Terkirim !',{ positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width' });</script>
    @endif
@endsection