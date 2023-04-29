@extends('layouts.aig')

@section('title', __('users.reset_password'))

@section('content')
<div class="login-container">
    <div class="section_login">
        <form role="form" method="POST" action="{{ route('password.email') }}" class="smart-form client-form">
            @csrf
            <header>
                <span> <img class="login_img" src="{{ asset('img/login_head.png') }}" alt=""></span>
            </header>

            <fieldset>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="label">@lang('users.remember')</label>
                    <label class="input"> <i class="icon-prepend fa fa-envelope"></i>
                        <input id="email" type="text" name="email" value="{{ old('email') }}"
                            placeholder="*@lang('users.email')">
                        <b class="tooltip tooltip-top-left">
                            <i class="fa fa-envelope txt-color-teal"></i>
                            @lang('base_lang.email')
                        </b>
                    </label>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary mb-3">
                        @lang('users.reset_password')
                    </button>
                    <a class="btn btn-primary mb-3" href="{{ url('login') }}">
                        @lang('base_lang.cancel')
                    </a>
                </div>
            </fieldset>
        </form>
    </div>
</div>

@endsection