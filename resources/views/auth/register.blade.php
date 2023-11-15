@extends('layouts.app')

@section('content')
    <section class="login-register-area section-space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="login-register-content p-4 shadow">
                        <div class="login-register-title mb-30">
                            <h2>Register</h2>
                        </div>
                        <div class="login-register-style">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="login-register-input">
                                    <input type="text" name="name" placeholder="Name"
                                        class="@error('name') is-invalid @enderror" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="login-register-input">
                                    <input type="email" name="email" placeholder="Email Address"
                                        class="@error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="login-register-input">
                                    <input type="password" name="password" placeholder="Password"
                                        class="@error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="login-register-input">
                                    <input type="password" name="password_confirmation" placeholder="Confirm Password"
                                        class="">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="btn-register">
                                    <button type="submit" class="btn-register-now">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
