@extends('layouts.menu')

@section('title', __('base_lang.networks') . ' - ' . __('base_lang.edit'))

@section('title_page')
<i class="fas fa-wifi"></i>&nbsp;@lang('base_lang.networks')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.edit')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;{{$network->name ?? ''}}
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-12">

            @permission(['view_networks', 'all_networks'])
            <div class="mb-2">
                <a href="{{ route('networks.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-lg fa-wifi"></i>
                    @lang('networks.view_networks')
                </a>
            </div>
            @endpermission

            <div class="panel panel-default">
                <div class="panel-body body_form">
                    <div class="card card-secondary mb-2">
                        @include('networks._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection