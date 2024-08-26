@extends('layouts.guest_b')
@section('test')
    <form action="{{ route('login_b') }}" method="post">
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
