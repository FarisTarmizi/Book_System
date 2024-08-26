{{--<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                          autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"/>
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>
            <div class="input-icon-div">
                <div class="input-icon-div">
                    <i class="far fa-eye"></i>
                    <i class="far fa-eye" id="togglePassword"></i>
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2"/>

            </div>
        </div>


        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>--}}
{{--@section('content')
    <form method="POST" action="{{ route('login') }}" class="text-center">
        @csrf
        <!-- Email Address -->
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" autofocus
                   autocomplete="username">
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
                <input id="password" type="password" name="password" class="form-control"
                       autocomplete="current-password">
                <div class="input-group-append">
                <span class="input-group-text">
                    <i class="far fa-eye" id="togglePassword"></i>
                </span>
                </div>
            </div>
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-group form-check">
            <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
            <label class="form-check-label" for="remember_me">Remember me</label>
        </div>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-decoration-none float-left">Forgot your password?</a>
        @endif
        <button type="submit" class="btn btn-primary float-right">Log in</button>
    </form>

@endsection--}}
@extends('layouts.guest')
@section('test')
    <form action="{{ route('login') }}" method="post">
        @csrf
        <!-- Email -->
        <div class="input-group mb-3">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                   value="{{ old('email') }}" autofocus autocomplete="email">

            <div class="input-group-append" style="width: 40px;">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="input-group mb-3">
            <div style="border: 1px grey solid; display: inline-block; width: 87.7%;">
                <input id="password" type="password" name="password" class="form-control" placeholder="Password"
                       autocomplete="current-password"
                       style="border: none; display: inline-block; width: calc(100% - 30px); padding-right: 30px;">
                <i class="far fa-eye" id="togglePassword"
                   style="display: inline-block; vertical-align: middle; cursor: pointer;"></i>
            </div>
            <div class="input-group-append" style="width: 40px;">
        <span class="input-group-text">
            <i class="fas fa-lock"></i>
        </span>
            </div>
        </div>


        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember" class="mt-2">
                        Remember Me
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
