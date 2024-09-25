@extends('auth.app')

@section('title', 'Login')

<style>
    body {
        background: linear-gradient(to right, #f5f7fa, #c3cfe2);
        height: 100vh;
    }

    .login-container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .login-form {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        max-width: 1000px;
        width: 100%;
    }

    .login-form-right {
        flex: 1;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-form-left {
        flex: 1;
        background-image: url("{{ asset('assets/img/bg.png') }}");
        background-size: cover;
        background-position: center;
        display: none;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
    }

    .btn-social {
        width: 100%;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-social i {
        margin-right: 10px;
    }

    .divider {
        text-align: center;
        margin: 20px 0;
        position: relative;
    }

    .divider::before, .divider::after {
        content: '';
        position: absolute;
        width: 45%;
        height: 1px;
        background: #ddd;
        top: 50%;
    }

    .divider::before {
        left: 0;
    }

    .divider::after {
        right: 0;
    }

    .divider span {
        background: #fff;
        padding: 0 10px;
        color: #aaa;
    }
</style>

<div class="login-container">
    <div class="login-form">
        <div class="login-form-left d-none d-md-block"></div>

        <div class="login-form-right">
            <h3 class="mb-3 text-center">Login to Klinik Sehat</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Email<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    </div>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Password<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="bi bi-eye-slash" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <a href="#" class="text-primary text-decoration-none">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>

                <div class="divider"><span>OR</span></div>

                <a href="#" class="btn btn-social btn-primary">
                    <i class="fab fa-facebook-f"></i> Continue with Facebook
                </a>
                <a href="#" class="btn btn-social btn-info">
                    <i class="fab fa-twitter"></i> Continue with Twitter
                </a>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        eyeIcon.classList.toggle('bi-eye-slash');
        eyeIcon.classList.toggle('bi-eye');
    });
</script>
