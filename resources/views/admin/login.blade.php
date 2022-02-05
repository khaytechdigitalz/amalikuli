@extends('layouts.auth')

@section('contents')
    <div class="loginbox">
        <div class="login-right">
            <div class="login-right-wrap">
                <h1>Login</h1>
                <p class="account-subtitle">Access to Admin dashboard</p>


                <x-jet-validation-errors class="mb-4 alert-danger alert-dismissible alert"/>


                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif


                <form method="" action="{{url('admin/dashboard')}}">
                    @csrf

                    <div class="form-group">
                        <label for="phone" class="form-control-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control pass-input"
                               value="{{old('email')}}" required autofocus/>
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

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
