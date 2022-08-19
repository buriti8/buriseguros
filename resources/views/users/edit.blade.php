@extends('layouts.menu')

@section('title', __('base_lang.users') . ' - ' . __('base_lang.edit'))

@section('title_page')
<i class="fa fa-users"></i>&nbsp;@lang('base_lang.users')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.edit')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;{{$user->full_name}}
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="mb-2">
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary ">
                    <i class="fa fa-lg fa-fw fa-plus"></i>
                    @lang('users.new_user')
                </a>
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary ">
                    <i class="fa fa-lg fa-fw fa-users"></i>
                    @lang('users.view_user')
                </a>
            </div>

            <div class="panel panel-default">
                <div class="panel-body body_form">
                    <div class="card card-secondary mb-2">
                        @include('users._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script src="{{ url(mix('js/users.js')) }}"></script>
@endsection