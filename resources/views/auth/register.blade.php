@extends('layouts_cart.menu')

@section('title', __('Registrarse'))

@section('content_page')

<div class="section">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center pb-2">@lang('users.register')</h2>
                        <form method="POST" action="{{ url('register') }}" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name">@lang('users.name') *</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="@lang('users.name')"
                                            value="{{ old('name',$user->name ?? '')}}">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">@lang('users.last_name') *</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            placeholder="@lang('users.last_name')"
                                            value="{{ old('last_name',$user->last_name ?? '')}}">
                                        @if ($errors->has('last_name'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="email">@lang('users.email') *</label>
                                        <input type="mail" class="form-control" id="email" name="email"
                                            placeholder="@lang('users.email')"
                                            value="{{ old('email',$user->email ?? '')}}">
                                        @if ($errors->has('email'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="password">@lang('users.password') *</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="@lang('users.password')" autocomplete="new-password">
                                        @if ($errors->has('password'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                        <small
                                            class="form-text text-muted text-justify">@lang('base_lang.password_rules')
                                        </small>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 pb-2">
                                    <div class="form-group">
                                        <label for="con-pass">@lang('users.password_confirmation') *</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation"
                                            placeholder="@lang('users.password_confirmation')">
                                        @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 pb-2">
                                    <small><strong>* </strong>@lang('base_lang.required')</small>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <button type="submit"
                                        class="btn btn-cart-primary mb-1">@lang('users.register')</button>
                                    <a href="{{route('cart.home')}}"
                                        class="btn btn-cart-secondary mb-1">@lang('base_lang.cancel')
                                    </a>
                                    <p class="form-text pt-2"><ins><a href="{{route('cart.login')}}">O
                                                @lang('users.login')</a></ins></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection