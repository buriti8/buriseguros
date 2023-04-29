@extends('layouts.menu')

@section('title', __('base_lang.lists'))

@section('title_page')
<i class="fas fa-th-list"></i>&nbsp;@lang('base_lang.lists')
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row">
        <div class="col col-12">@include('layouts.message')</div>
        <div class="col-md-12">
            @permission(['edit_lists', 'view_lists', 'all_lists'])
            <div class="card card-secondary mb-2">
                <div class="d-none d-md-block card-header py-1 px-2">
                    <h3 class="card-title">@lang('base_lang.searching')</h3>
                </div>
                <div class="d-none d-md-block pl-3 pr-3 pt-2 pb-1">
                    @include('lists._search')
                </div>

                <div class="d-blok d-md-none card-header py-1 px-2" data-bs-toggle="collapse" href="#collapseExample"
                    role="button" aria-expanded="false" aria-controls="collapseExample">
                    <h3 class="card-title">@lang('base_lang.searching')</h3>
                    <i class="float-right fas fa-angle-down text-white"></i>
                </div>
                <div class="d-blok d-md-none collapse p-3" id="collapseExample">
                    @include('lists._search')
                </div>
            </div>
            @endpermission

            <div class="button-w-100 pb-1">
                @permission(['edit_lists', 'all_lists'])
                <a href="{{ route('lists.create') }}" class="btn btn-sm btn-primary mb-1">
                    <i class="fa fa-lg fa-plus"></i>&nbsp;@lang('lists.new_list')
                </a>
                @endpermission
            </div>

            @permission(['edit_lists', 'view_lists', 'all_lists'])
            @include('vendor.pagination.record-count',
            ['paginator' => $lists_options, 'show_more_records' => false])
            <div class="table-responsive pt-2">
                @include('lists._table')
            </div>
            {{$lists_options->links()}}
            @endpermission
        </div>
    </div>
</div>
@endsection