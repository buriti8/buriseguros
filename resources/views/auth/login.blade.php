@extends('layouts.aig')

@section('title', '| ' . __('auth.login'))

@section('content')
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            <div class="mb-3 text-center">
                <a href="{{route('page.index')}}">
                    <img src="{{ route('contact.image', 1) }}" alt="Logo">
                </a>
            </div>
            <form role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }} </p>
                @endif
                @if(Session::has('message_danger'))
                <p class="alert alert-danger">{{ Session::get('message_danger') }} </p>
                @endif
                <div class="input-group mb-3">
                    <input id="username" type="text"
                        class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username"
                        value="{{ old('username') }}" placeholder="{{Lang::get('users.username')}}">
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
                        placeholder="{{Lang::get('users.password')}}">
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
        </div>
    </div>
</div>

@endsection