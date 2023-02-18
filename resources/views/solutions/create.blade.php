@extends('layouts.menu')

@section('title', '| ' . __('base_lang.solutions') . ' - ' . __('base_lang.new'))

@section('title_page')
<i class="fas fa-lock"></i>&nbsp;@lang('base_lang.solutions')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.new')
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-12">

            @permission(['view_solutions', 'all_solutions'])
            <div class="mb-2">
                <a href="{{ route('solutions.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-lock"></i>
                    @lang('solutions.view_solutions')
                </a>
            </div>
            @endpermission

            <div class="panel panel-default">
                <div class="panel-body body_form">
                    <div class="card card-secondary mb-2">
                        @include('solutions._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection