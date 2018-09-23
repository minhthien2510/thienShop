@extends('layouts.master')

@section('title', 'Login')

@section('content')
    <div class="heading-container">
        <div class="container heading-standar">
            <div class="page-breadcrumb">
                <ul class="breadcrumb">
                    <li>
                        <span>
                            <a class="home" href="{{ route('home') }}">
                                <span>Home</span>
                            </a>
                        </span>
                    </li>
                    <li>
                        <span>Login</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content-container no-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-content">
                        <div class="commerce commerce-account">
                            <h2 class="commerce-account-heading">Login</h2>
                            <form class="login" action="{{ route('postLogin') }}" method="post">
                                {{ csrf_field() }}
                                @if ($errors->has('warning'))
                                    <div class="alert alert-danger" role="alert">
                                        <i class="fa fa-exclamation-circle"></i>
                                        {{ $errors->first('warning') }}
                                    </div>
                                @endif
                                <div class="form-row form-row-wide">
                                    <label for="name">Email <span class="required">*</span></label>
                                    <input type="text" class="input-text" name="email" value="{{ old('email') }}"/>
                                    @if ($errors->has('email'))
                                        <div class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-row form-row-wide">
                                    <label for="password">Password <span class="required">*</span></label>
                                    <input type="password" class="input-text" name="password"/>
                                    @if ($errors->has('password'))
                                        <div class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-row">
                                    <label for="remember" class="inline form-flat-checkbox">
                                        <input type="checkbox" name="remember" id="remember" value="false"/><i></i> Remember me
                                    </label>
                                    <span class="pull-right">
                                        <a href="#lostpassword">Lost your password?</a>
                                    </span><br><br>
                                    <button type="submit" class="btn btn-primary btn-black-outline rounded">Login</button>
                                </div>
                                <div class="lost_password">
                                    <a href="{{ route('getRegister') }}">Not a Member yet?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection