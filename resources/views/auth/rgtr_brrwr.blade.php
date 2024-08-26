@extends('management.layout.test')
@section('nav','LIBRARY LOAN MANAGEMENT SYSTEM')
@section('nme','BOOK SYSTEM')
@section('title','REGISTRATION')
@if(Session::has('error'))
    <script>
        alert('{{ Session::get('error') }}');
    </script>
@endif
@section('content')
    <div class="hold-transition register-box" style="margin-left: 40%;margin-top: 7%">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>REGISTRATION</b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Register a new Account</p>

                    <form action="#" method="post">
                        @csrf
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" placeholder="Matrix Card / ID" name="id">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-portrait"></span>
                                </div>
                            </div>
                        </div>
                        @error('id')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" placeholder="Full name" name="name"
                                   value="{{old('name')}}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="input-group mb-1">
                            <input type="email" class="form-control" placeholder="Email" name="email"
                                   value="{{old('email')}}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                                    <label for="agreeTerms">
                                        I agree to the <a href="#">terms</a>
                                    </label>
                                </div>
                                @error('term')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                        </div>
                    </form>
                    {{--<div class="social-auth-links text-center">
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i>
                            Sign up using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i>
                            Sign up using Google+
                        </a>
                    </div>--}}
                    <a href="{{route('login_b')}}" class="text-center">I already have a account</a>
                </div>
            </div>
        </div>
    </div>
@endsection
