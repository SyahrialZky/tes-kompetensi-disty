@extends('auth.app')

@section('title', 'Login')

<div class="login-page">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-lg-6">
                <h3 class="mb-3">Login</h3>
                <div class="bg-white shadow rounded">
                    <div class="row">
                        <div class="col-md-7 pe-0">
                            <div class="form-left h-100 py-5 px-5">
                                <form action="{{ route('login') }}" method="POST" class="row g-4">
                                    @csrf
                                    <div class="col-12">
                                        <label>Email<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                                        </div>
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label>Password<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                        </div>
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    
                                    <div class="col-sm-6">
                                        <a href="#" class="float-end text-primary text-decoration-none">Forgot Password?</a>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-4 float-end mt-4">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 ps-0 d-none d-md-block">
                            <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                <i class="bi bi-bootstrap"></i>
                                <h2 class="fs-1">Welcome Back!!!</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-end text-secondary mt-3">Melayani dengan sepenuh hati</p>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

