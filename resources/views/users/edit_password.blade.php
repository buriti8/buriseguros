@extends('layouts.menu')

@section('title', __('base_lang.users') . ' - ' . __('users.change_password'))

@section('title_page')
<i class="fa fa-users"></i>&nbsp;@lang('base_lang.users')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('users.change_password')
@endsection

@section('content_page')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="mb-2">
                <a href="{{ url('/users/create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-lg fa-fw fa-plus"></i>
                    @lang('users.new_user')
                </a>
                <a href="{{ url('/users') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-lg fa-fw fa-users"></i>
                    @lang('users.view_user')
                </a>
                <a href="{{ url('/roles') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-lg fa-fw fa-crosshairs "></i>&nbsp;@lang('users.view_roles')
                </a>
            </div>

            <div class="panel panel-default">
                <div class="panel-body body_form">
                    <div class="card card-secondary mb-2">
                        @include('users.change_password')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection