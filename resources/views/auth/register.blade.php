@extends('layouts.master')

@section('title', 'Register')

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
                        <span>Register</span>
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
                            <h2 class="commerce-account-heading">Register</h2>
                            <form class="register">
                                <div class="error"></div>
                                <div class="form-row form-row-wide email">
                                    <label for="email">Email <span class="required">*</span></label>
                                    <input type="text" class="input-text" id="email-r" value="" required/>
                                    <span class="errorEmail help-block"></span>
                                </div>
                                <div class="form-row form-row-wide password">
                                    <label for="password">Password <span class="required">*</span></label>
                                    <input class="input-text" type="password" id="password-r" required/>
                                    <span class="errorPassword help-block"></span>
                                </div>
                                <div class="form-row form-row-wide passwordConfirm">
                                    <label for="re_password">Retype Password <span class="required">*</span></label>
                                    <input class="input-text" type="password" id="re_password" required/>
                                    <span class="errorPasswordConfirm help-block"></span>
                                </div>
                                <div class="form-row">
                                    <button type="button" class="btn btn-primary rounded" id="register">Register</button>
                                </div>
                                <div class="lost_password">
                                    <span class="user-login-modal-link pull-left">
                                        <a href="{{ route('getLogin') }}">Already have an account?</a>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection