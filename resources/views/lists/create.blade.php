@extends('layouts.menu')

@section('title', __('base_lang.lists') . ' - ' . __('base_lang.new'))

@section('title_page')
<i class="fas fa-th-list"></i>&nbsp;@lang('base_lang.lists')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.new')
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-12">

            @permission(['view_lists', 'all_lists'])
            <div class="mb-2">
                <a href="{{ route('lists.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-lg fa-th-list"></i>
                    @lang('lists.view_lists')
                </a>
            </div>
            @endpermission

            <div class="panel panel-default">
                <div class="panel-body body_form">
                    <div class="card card-secondary mb-2">
                        @include('lists._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection