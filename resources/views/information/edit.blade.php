@extends('layouts.menu')

@section('title', '| ' . __('base_lang.information') . ' - ' . __('base_lang.edit'))

@section('title_page')
<i class="fas fa-info"></i>&nbsp;@lang('base_lang.information')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.edit')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;{{$information->name ?? ''}}
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-12">

            @permission(['view_information', 'all_information'])
            <div class="mb-2">
                <a href="{{ route('information.show', 1) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-info"></i>
                    @lang('information.view_information')
                </a>
            </div>
            @endpermission

            <div class="panel panel-default">
                <div class="panel-body body_form">
                    <div class="card card-secondary mb-2">
                        @include('information._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection