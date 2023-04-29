@extends('layouts.menu')

@section('title', __('base_lang.insurances'))

@section('title_page')
<i class="fas fa-shield-alt"></i>&nbsp;@lang('base_lang.insurances')
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row">
        <div class="col col-12">@include('layouts.message')</div>
        <div class="col-md-12">
            @permission(['edit_insurances', 'view_insurances', 'all_insurances'])
            <div class="card card-secondary mb-2">
                <div class="d-none d-md-block card-header py-1 px-2">
                    <h3 class="card-title">@lang('base_lang.searching')</h3>
                </div>
                <div class="d-none d-md-block pl-3 pr-3 pt-2 pb-1">
                    @include('insurances._search')
                </div>

                <div class="d-blok d-md-none card-header py-1 px-2" data-bs-toggle="collapse" href="#collapseExample"
                    role="button" aria-expanded="false" aria-controls="collapseExample">
                    <h3 class="card-title">@lang('base_lang.searching')</h3>
                    <i class="float-right fas fa-angle-down text-white"></i>
                </div>
                <div class="d-blok d-md-none collapse p-3" id="collapseExample">
                    @include('insurances._search')
                </div>
            </div>
            @endpermission

            <div class="button-w-100 pb-1">
                @permission(['edit_insurances', 'all_insurances'])
                <a href="{{ route('insurances.create') }}" class="btn btn-sm btn-primary mb-1">
                    <i class="fa fa-lg fa-plus"></i>&nbsp;@lang('insurances.new_insurance')
                </a>
                @endpermission
            </div>

            @permission(['edit_insurances', 'view_insurances', 'all_insurances'])
            @include('vendor.pagination.record-count',
            ['paginator' => $insurances, 'show_more_records' => false])
            <div class="table-responsive pt-2">
                @include('insurances._table')
            </div>
            {{$insurances->links()}}
            @endpermission
        </div>
    </div>
</div>
@endsection