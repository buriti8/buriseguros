@extends('layouts.menu')

@section('title', __('base_lang.contacts') . ' - ' . __('base_lang.edit'))

@section('title_page')
<i class="fas fa-info"></i>&nbsp;@lang('base_lang.contacts')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.edit')
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-12">

            @permission(['view_contacts', 'all_contacts'])
            <div class="mb-2">
                <a href="{{ route('contacts.show', 1) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-info"></i>
                    @lang('contacts.view_contacts')
                </a>
            </div>
            @endpermission

            <div class="panel panel-default">
                <div class="panel-body body_form">
                    <div class="card card-secondary mb-2">
                        @include('contacts._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection