@extends('layouts.menu')

@section('title', __('base_lang.roles'))

@section('title_page')
<i class="fas fa-tags"></i>&nbsp;@lang('base_lang.roles')
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row">
        <div class="col col-12">@include('layouts.message')</div>
        <div class="col-md-12">
            <div class="card card-secondary mb-2">
                <div class="card-header py-1 px-2">
                    <h3 class="card-title">@lang('users.new_role')</h3>
                </div>
                <div class="p-3">
                    @include('roles._form')
                </div>
            </div>

            <div class="pb-3">
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-lg fa-fw fa-users"></i>&nbsp;@lang('users.view_user')
                </a>
            </div>

            @include('vendor.pagination.record-count', ['paginator' => $roles, 'show_more_records' => false])

            <div class="table-responsive pt-3">
                @include('roles._table')
            </div>
            {{$roles->links()}}
        </div>
    </div>
</div>
@endsection