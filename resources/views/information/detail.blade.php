@extends('layouts.menu')

@section('title', __('base_lang.information') . ' - ' . __('base_lang.detail'))

@section('title_page')
<i class="fas fa-info"></i>&nbsp;@lang('base_lang.information')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.detail')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;{{$information->name ?? ''}}
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col col-12">@include('layouts.message')</div>
        <div class="col-12">
            <div class="button-w-100 mb-2">
                @permission(['edit_information', 'all_information'])
                <a href="{{ route('information.edit', $information->id) }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fa fa-lg fa-edit"></i>
                    @lang('information.edit_information')
                </a>
                @endpermission
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
                                    <td><b>@lang('information.name')</b></td>
                                    <td class="background_color">
                                        {{$information->name ?? ''}}
                                    </td>
                                    <td><b>@lang('information.description')</b></td>
                                    <td class="background_color">
                                        {{$information->description ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>@lang('information.phone')</b></td>
                                    <td class="background_color">
                                        {{$information->phone ?? ''}}
                                    </td>
                                    <td><b>@lang('information.mobile')</b></td>
                                    <td class="background_color">
                                        {{$information->mobile ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>@lang('information.email')</b></td>
                                    <td class="background_color">
                                        {{$information->email ?? ''}}
                                    </td>
                                    <td><b>@lang('information.address')</b></td>
                                    <td class="background_color">
                                        {{$information->address ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>@lang('information.image')</b></td>
                                    <td class="background_color" colspan="3">
                                        <img src="{{ route('information.image', 1) }}?{{rand(0, 1000)}}" alt=""
                                            width="300" height="64">
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
                                        {{$information->created_at ?? ''}}
                                    </td>

                                    <td><b>@lang('base_lang.created_by_id')</b></td>
                                    <td class="background_color">
                                        {{$information->created_by->full_name ?? ''}}
                                    </td>

                                    @if ($information->updated_by_id)
                                    <td><b>@lang('base_lang.updated_at')</b></td>
                                    <td class="background_color">
                                        {{$information->updated_at ?? ''}}
                                    </td>

                                    <td><b>@lang('base_lang.updated_by_id')</b></td>
                                    <td class="background_color">
                                        {{$information->updated_by->full_name ?? ''}}
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