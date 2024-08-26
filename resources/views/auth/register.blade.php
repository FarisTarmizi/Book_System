@extends('management.layout.test')
@section('nav','LIBRARY LOAN MANAGEMENT SYSTEM')
@section('nme','BOOK SYSTEM')
@section('title','REGISTER')
@section('content')
    <x-auth-session-status class="mb-4" :status="session('status')"/>
    <div class="container mt-5">
        <div class="hold-transition login-box" style="margin-left: 35%;margin-top: 10%">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>BOOK SYSTEM</b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form action="{{route('register')}}" method="post">
                        @csrf
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="NAME" name="name"
                                   value="{{old('name')}}" required autofocus autocomplete="name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="input-group mb-2">
                            <input type="email" class="form-control" placeholder="XXXX@XXX" name="email"
                                   value="{{old('email')}}" required autofocus autocomplete="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="input-group mb-2">
                            <input type="password" class="form-control" placeholder="PASSWORD" name="password"
                                   required autocomplete="new-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="input-group mb-2">
                            <input type="password" class="form-control" placeholder="CONFIRM PASSWORD"
                                   name="password_confirmation" required autocomplete="new-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password_confirmation')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="row mt-2">
                            <div class="col-8">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                   href="{{ route('login_b') }}">
                                    Already registered?
                                </a>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
