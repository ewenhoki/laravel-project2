@extends('layouts.master')

@section('header')
    <title>Math Unpad - Profile</title>
@endsection

@section('content')
<div class="page-wrapper page-header">
    <!-- ============================================================== -->
    <!-- Title and breadcrumb -->
    <!-- ============================================================== -->
    <div class="card warning-gradient m-t-0 m-b-0">
        <div class="card-content">
            <div class="p-b-40 p-t-20">
                <h3 class="white-text">Welcome back {{ auth()->user()->name }} !</h3>
                <p class="white-text op-7 m-b-20">Success is not a destination, its a Journey!!!</p>
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
                        <small>Email address </small>
                        <h6>{{ auth()->user()->email }}</h6>
                        <small>Phone Number </small>
                        <h6>{{ auth()->user()->phone }}</h6>
                        <small>NPM</small>
                        <h6>{{ $student->npm }}</h6>
                        <small>First Name</small>
                        <h6>{{ $student->first_name }}</h6>
                        <small>Last Name</small>
                        <h6>{{ $student->last_name }}</h6>
                        <small>GPA</small>
                        <h6>{{ $student->gpa }}</h6>
                        <small>Supervisor 1</small>
                        <h6>-</h6>
                        <small>Supervisor 2</small>
                        <h6>-</h6>
                    </div>
                </div>
            </div>
            <div class="col s8">
                <div class="card">
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s3"><a class="active" href="#timeline">Timeline</a></li>
                                <li class="tab col s3"><a href="#settings">Settings</a></li>
                            </ul>
                        </div>
                        <div id="timeline" class="col s12">
                            <div class="card-content">
                                <div class="profiletimeline">
                                    <hr>
                                    <div class="sl-item">
                                        <div class="sl-left"> <img src="{{ asset('admin/img/profile-default.png')}}" alt="user" class="circle" /> </div>
                                        <div class="sl-right">
                                            <div><a href="javascript:void(0)" class="">{{ auth()->user()->name }}</a> <span class="sl-date">5 minutes ago</span>
                                                <p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="sl-item">
                                        <div class="sl-left"> <img src="{{ asset('admin/img/profile-default.png')}}" alt="user" class="circle" /> </div>
                                        <div class="sl-right">
                                            <div><a href="javascript:void(0)" class="">{{ auth()->user()->name }}</a> <span class="sl-date">5 minutes ago</span>
                                                <blockquote class="m-t-10">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="settings" class="col s12">
                            <div class="card-content">
                                {!! Form::open(['url' => '/poststudentprofile','class'=>'formValidate','id'=>'formValidate']) !!}  
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {!! Form::text('first_name', auth()->user()->student->first_name, ['placeholder'=>'First Name']) !!}
                                            <label for="first_name">First Name</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {!! Form::text('last_name', auth()->user()->student->last_name, ['placeholder'=>'Last Name']) !!}
                                            <label for="last_name">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {!! Form::text('gpa', auth()->user()->student->gpa, ['placeholder'=>'GPA']) !!}
                                            <label for="gpa">GPA</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {!! Form::text('phone', auth()->user()->phone, ['placeholder'=>'Phone']) !!}
                                            <label for="phone">Phone Number</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            {!! Form::password('password',['placeholder'=>'New Password']) !!}
                                            <label for="password">Change Password</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn teal waves-effect waves-light" type="submit" name="action">Update Profile</button>
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
                    gpa: {
                        required: true,
                        min: 1,
                        max: 4,
                    },
                    password: {
                        minlength: 8,
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
@endsection