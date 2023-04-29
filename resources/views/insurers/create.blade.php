@extends('layouts.menu')

@section('title', __('base_lang.insurers') . ' - ' . __('base_lang.new'))

@section('title_page')
<i class="fas fa-briefcase"></i>&nbsp;@lang('base_lang.insurers')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.new')
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-12">

            @permission(['view_insurers', 'all_insurers'])
            <div class="mb-2">
                <a href="{{ route('insurers.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-lg fa-briefcase"></i>
                    @lang('insurers.view_insurers')
                </a>
            </div>
            @endpermission

            <div class="panel panel-default">
                <div class="panel-body body_form">
                    <div class="card card-secondary mb-2">
                        @include('insurers._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection