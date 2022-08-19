@extends('layouts.menu')

@section('title', __('base_lang.users'))

@section('title_page')
<i class="fa fa-users"></i>&nbsp;@lang('base_lang.users')
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row">
        <div class="col col-12">@include('layouts.message')</div>
        <div class="col-md-12">
            <div class="card card-secondary mb-2">
                <div class="d-none d-md-block card-header py-1 px-2">
                    <h3 class="card-title">@lang('base_lang.searching')</h3>
                </div>
                <div class="d-none d-md-block pl-3 pr-3 pt-2 pb-1">
                    @include('users._search')
                </div>

                <div class="d-blok d-md-none card-header py-1 px-2" data-toggle="collapse" href="#collapseExample"
                    role="button" aria-expanded="false" aria-controls="collapseExample">
                    <h3 class="card-title">@lang('base_lang.searching')</h3>
                    <i class="float-right fas fa-angle-down"></i>
                </div>
                <div class="d-blok d-md-none collapse p-3" id="collapseExample">
                    @include('users._search')
                </div>
            </div>

            <div class="pb-3">
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-lg fa-fw fa-plus"></i>&nbsp;@lang('users.new_user')
                </a>
                <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-tags"></i>&nbsp;@lang('users.view_roles')
                </a>
            </div>
            @include('vendor.pagination.record-count', ['paginator' => $users, 'show_more_records' => false])
            <div class="table-responsive pt-3">
                @include('users._table')
            </div>
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection