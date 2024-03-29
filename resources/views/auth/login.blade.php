@extends('layouts.aig')

@section('title', __('auth.login'))

@section('content')
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            <div class="mb-3 text-center">
                <img src="{{ asset('img/logo.png')}}?{{rand(0, 1000)}}" alt="Logo">
            </div>
            
            @include('layouts.message')
            
            <form role="form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="username" type="text"
                        class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username"
                        value="{{ old('username') }}" placeholder="@lang('users.username')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    @if($errors->has('username'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password"
                        placeholder="@lang('users.password')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                    @if($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">@lang('base_lang.enter')</button>
                    </div>
                </div>
            </form>
            <div class="text-center mt-4">
                <a style="color: #666666 !important;" class="" href="{{ route('password.request') }}">
                    @lang('base_lang.remember_password')
                </a>
            </div>
        </div>
    </div>
</div>

@endsection