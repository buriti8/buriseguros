@extends('layouts.menu')

@section('title', __('base_lang.networks') . ' - ' . __('base_lang.detail'))

@section('title_page')
<i class="fas fa-wifi"></i></i>&nbsp;@lang('base_lang.networks')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.detail')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;{{$network->name ?? ''}}
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col col-12">@include('layouts.message')</div>
        <div class="col-12">
            <div class="button-w-100 mb-2">
                @permission(['edit_networks', 'all_networks'])
                <a href="{{ route('networks.create') }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fa fa-lg fa-plus"></i>
                    @lang('networks.new_network')
                </a>
                <a href="{{ route('networks.edit', $network->id) }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fa fa-lg fa-edit"></i>
                    @lang('networks.edit_network')
                </a>
                @endpermission
                <a href="{{ route('networks.index') }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fas fa-lg fa-wifi"></i>
                    @lang('networks.view_networks')
                </a>
            </div>

            <div class="panel panel-default">
                <div class="panel-body body_form">

                    {{-- Sección información general --}}
                    <div class="w-100 title-module">
                        @lang('base_lang.general_information')
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-active">
                            <tbody>
                                <tr>
                                    <td><b>@lang('networks.name')</b></td>
                                    <td class="background_color">
                                        {{$network->name ?? ''}}
                                    </td>

                                    <td><b>@lang('networks.link')</b></td>
                                    <td class="background_color">
                                        {{$network->link ?? ''}}
                                    </td>

                                    <td><b>@lang('networks.icon')</b></td>
                                    <td class="background_color">
                                        <i class="{{ $network->icon }}"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Sección información personal --}}
                    <div class="w-100 title-module">
                        @lang('base_lang.data_information')
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-active">
                            <tbody>
                                <tr>
                                    <td><b>@lang('base_lang.created_at')</b></td>
                                    <td class="background_color">
                                        {{$network->created_at ?? ''}}
                                    </td>

                                    <td><b>@lang('base_lang.created_by_id')</b></td>
                                    <td class="background_color">
                                        {{$network->created_by->full_name ?? ''}}
                                    </td>

                                    @if ($network->updated_by_id)
                                    <td><b>@lang('base_lang.updated_at')</b></td>
                                    <td class="background_color">
                                        {{$network->updated_at ?? ''}}
                                    </td>

                                    <td><b>@lang('base_lang.updated_by_id')</b></td>
                                    <td class="background_color">
                                        {{$network->updated_by->full_name ?? ''}}
                                    </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection