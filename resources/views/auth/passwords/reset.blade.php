@extends('layouts.aig')

@section('title', __('users.reset_password'))

@section('content')
<div class="login-container">
    <div class="section_login">
        <form role="form" method="POST" action="{{ route('password.request') }}" class="smart-form client-form">
            @csrf
            <header>
                <span> <img class="login_img" src="{{ asset('img/login_head.png') }}" alt=""></span>
            </header>
            <input type="hidden" name="token" value="{{ $token }}">
            <fieldset>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <section class="col-xs-12">
                        <label class="input"> <i class="icon-append fa fa-envelope"></i>
                            <input id="email" type="text" name="email" value="{{ old('email') }}"
                                placeholder="*@lang('base_lang.email')">
                            <b class="tooltip tooltip-top-right">
                                <i class="fa fa-envelope txt-color-teal"></i>
                                *@lang('base_lang.email')
                            </b>
                        </label>
                    </section>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <br>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <section class="col-xs-12">
                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                            <input id="password" type="password" class="form-control" name="password"
                                placeholder="*@lang('users.new_password')" title="@lang('users.new_password')">
                            <b class="tooltip tooltip-top-right">
                                <i class="fa fa-lock txt-color-teal"></i>
                                *@lang('users.new_password')
                            </b>
                        </label>
                    </section>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <br>
                <div class="form-group">
                    <section class="col-xs-12">
                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" placeholder="*@lang('users.new_password_confirmation')"
                                title="@lang('users.new_password_password')">
                            <b class="tooltip tooltip-top-right">
                                <i class="fa fa-lock txt-color-teal"></i>
                                *@lang('users.new_password_confirmation')
                            </b>
                        </label>
                    </section>
                    @if($errors->has('confirm_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('confirm_password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary width_100">
                        @lang('users.reset_password')
                    </button>
                </div>
            </fieldset>
        </form>
    </div>
</div>

@endsection