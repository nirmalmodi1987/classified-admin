@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
    <style>
        body {
            background-color: #f4f6f9; /* Light background color */
        }
        .login-box {
            width: 400px;
            margin: 7% auto; /* Center the login box */
            padding: 20px;
            background: white; /* White background for the login box */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .login-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-logo img {
            width: 100px; /* Logo size */
        }
        .form-control {
            border-radius: 5px; /* Rounded input fields */
        }
        .btn-primary {
            width: 100%; /* Full-width button */
            border-radius: 5px; /* Rounded button */
        }
    </style>
@stop

@section('body')
<div class="login-box">
    <div class="login-logo">
        <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo">
        <h4>Login</h4>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <form action="{{ route('admin.login.submit') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </form>
            <p class="mb-1">
                <a href="{{ route('admin.password.request') }}">I forgot my password</a>
            </p>
        </div>
    </div>
</div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop