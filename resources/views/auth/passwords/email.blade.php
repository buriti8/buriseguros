@extends('layouts.aig')

@section('title', __('users.reset_password'))

@section('content')
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            <span>
                <h1 class="login-box-msg text-uppercase"><strong>Buriseguros</strong></h1>
            </span>
            <form role="form" method="POST" action="{{ route('password.email') }}">
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
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-sm btn-primary mb-1">@lang('users.reset_password')</button>
                        <a href="{{url('/login')}}" class="btn btn-sm btn-primary mb-1">
                            @lang('base_lang.cancel')
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection