@extends('layouts.aig')

@section('title', __('users.reset_password'))

@section('content')
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            <span>
                <h1 class="login-box-msg text-uppercase"><strong>Buriseguros</strong></h1>
            </span>
            <form role="form" method="POST" action="{{ route('password.request') }}">
                @csrf
                @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }} </p>
                @endif
                @if(Session::has('message_danger'))
                <p class="alert alert-danger">{{ Session::get('message_danger') }} </p>
                @endif
                <div class="input-group mb-3">
                    <input id="email" type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        name="email" value="{{ old('email') }}" placeholder="@lang('users.email')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    @if($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password"
                        placeholder="@lang('users.new_password')">
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
                <div class="input-group mb-3">
                    <input id="password-confirm" type="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        name="password_confirmation" placeholder="@lang('users.new_password_confirmation')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                    @if($errors->has('confirm_password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('confirm_password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-sm btn-primary mb-1">@lang('users.reset_password')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection