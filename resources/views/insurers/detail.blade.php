@extends('layouts.menu')

@section('title', __('base_lang.insurers') . ' - ' . __('base_lang.detail'))

@section('title_page')
<i class="fas fa-briefcase"></i></i>&nbsp;@lang('base_lang.insurers')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.detail')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;{{$insurer->name ?? ''}}
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col col-12">@include('layouts.message')</div>
        <div class="col-12">
            <div class="button-w-100 mb-2">
                @permission(['edit_insurers', 'all_insurers'])
                <a href="{{ route('insurers.create') }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fa fa-lg fa-plus"></i>
                    @lang('insurers.new_insurer')
                </a>
                <a href="{{ route('insurers.edit', $insurer->id) }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fa fa-lg fa-edit"></i>
                    @lang('insurers.edit_insurer')
                </a>
                @endpermission
                <a href="{{ route('insurers.index') }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fas fa-lg fa-briefcase"></i>
                    @lang('insurers.view_insurers')
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
                                    @if($insurer->image)
                                    <td rowspan="4" style="border-right: 1px solid white;">
                                        <img src="{{ route('insurer.image', $insurer->id) }}?{{rand(0, 1000)}}"
                                            alt="@lang('insurers.image')">
                                    </td>
                                    @endif
                                    <td><b>@lang('insurers.name')</b></td>
                                    <td class="background_color">
                                        {{$insurer->name ?? ''}}
                                    </td>

                                    <td><b>@lang('insurers.link')</b></td>
                                    <td class="background_color">
                                        {{$insurer->link ?? ''}}
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
                                        {{$insurer->created_at ?? ''}}
                                    </td>

                                    <td><b>@lang('base_lang.created_by_id')</b></td>
                                    <td class="background_color">
                                        {{$insurer->created_by->full_name ?? ''}}
                                    </td>

                                    @if ($insurer->updated_by_id)
                                    <td><b>@lang('base_lang.updated_at')</b></td>
                                    <td class="background_color">
                                        {{$insurer->updated_at ?? ''}}
                                    </td>

                                    <td><b>@lang('base_lang.updated_by_id')</b></td>
                                    <td class="background_color">
                                        {{$insurer->updated_by->full_name ?? ''}}
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