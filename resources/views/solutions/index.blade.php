@extends('layouts.menu')

@section('title', __('base_lang.solutions'))

@section('title_page')
<i class="fas fa-lock"></i>&nbsp;@lang('base_lang.solutions')
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row">
        <div class="col col-12">@include('layouts.message')</div>
        <div class="col-md-12">
            @permission(['edit_solutions', 'view_solutions', 'all_solutions'])
            <div class="card card-secondary mb-2">
                <div class="d-none d-md-block card-header py-1 px-2">
                    <h3 class="card-title">@lang('base_lang.searching')</h3>
                </div>
                <div class="d-none d-md-block pl-3 pr-3 pt-2 pb-1">
                    @include('solutions._search')
                </div>

                <div class="d-blok d-md-none card-header py-1 px-2" data-bs-toggle="collapse" href="#collapseExample"
                    role="button" aria-expanded="false" aria-controls="collapseExample">
                    <h3 class="card-title">@lang('base_lang.searching')</h3>
                    <i class="float-right fas fa-angle-down text-white"></i>
                </div>
                <div class="d-blok d-md-none collapse p-3" id="collapseExample">
                    @include('solutions._search')
                </div>
            </div>
            @endpermission

            <div class="button-w-100 pb-1">
                @permission(['edit_solutions', 'all_solutions'])
                <a href="{{ route('solutions.create') }}" class="btn btn-sm btn-primary mb-1">
                    <i class="fa fa-lg fa-plus"></i>&nbsp;@lang('solutions.new_solution')
                </a>
                @endpermission
            </div>

            @permission(['edit_solutions', 'view_solutions', 'all_solutions'])
            @include('vendor.pagination.record-count',
            ['paginator' => $solutions, 'show_more_records' => false])
            <div class="table-responsive pt-2">
                @include('solutions._table')
            </div>
            {{$solutions->links()}}
            @endpermission
        </div>
    </div>
</div>
@endsection