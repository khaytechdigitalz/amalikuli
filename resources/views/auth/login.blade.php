@extends('layouts.auth')

@section('contents')
    <div class="loginbox">
        <div class="login-right">
            <div class="login-right-wrap">
                <h1>Login</h1>
                <p class="account-subtitle">Access to Your dashboard</p>

                <x-jet-validation-errors class="mb-4 alert-danger alert-dismissible alert"/>


                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600 alert-dismissible alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 font-medium text-sm alert-danger alert-dismissible alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 font-medium text-sm alert-success alert-dismissible alert">
                        {{ session('success') }}
                    </div>
                @endif


                <form method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="phone" class="form-control-label">Phone No</label>
                        <input type="tel" name="phone" id="phone" class="form-control pass-input"
                               value="{{old('phone')}}" maxlength="11" required autofocus/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Password</label>
                        <div class="pass-group">
                            <input type="password" name="password" class="form-control pass-input" required/>
                            <span class="fas fa-eye toggle-password"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="cb1" name="remember">
                                    <label class="custom-control-label" for="cb1">Remember me</label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                @if (Route::has('password.request'))
                                    <a class="forgot-link" href="{{ route('password.request') }}">Forgot Password ?</a>
                                @endif

                            </div>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-block btn-success w-100" type="submit">Sign-In</button>
                    <div class="login-or">
                        <span class="or-line"></span>
                        {{--                                <span class="span-or">or</span>--}}
                    </div>

                    {{--                            <div class="social-login mb-3">--}}
                    {{--                                <span>Login with</span>--}}
                    {{--                                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a><a href="#" class="google"><i class="fab fa-google"></i></a>--}}
                    {{--                            </div>--}}

                    <div class="text-center dont-have">Don't have an account yet? <a href="{{route('register')}}">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
