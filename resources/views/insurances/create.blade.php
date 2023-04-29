@extends('layouts.menu')

@section('title', __('base_lang.insurances') . ' - ' . __('base_lang.new'))

@section('title_page')
<i class="fas fa-shield-alt"></i>&nbsp;@lang('base_lang.insurances')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.new')
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-12">

            @permission(['view_insurances', 'all_insurances'])
            <div class="mb-2">
                <a href="{{ route('insurances.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-lg fa-shield-alt"></i>
                    @lang('insurances.view_insurances')
                </a>
            </div>
            @endpermission

            <div class="panel panel-default">
                <div class="panel-body body_form">
                    <div class="card card-secondary mb-2">
                        @include('insurances._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection