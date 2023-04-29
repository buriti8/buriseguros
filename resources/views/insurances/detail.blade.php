@extends('layouts.menu')

@section('title', __('base_lang.insurances') . ' - ' . __('base_lang.detail'))

@section('title_page')
<i class="fas fa-shield-alt"></i></i>&nbsp;@lang('base_lang.insurances')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.detail')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;{{$insurance->name ?? ''}}
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col col-12">@include('layouts.message')</div>
        <div class="col-12">
            <div class="button-w-100 mb-2">
                @permission(['edit_insurances', 'all_insurances'])
                <a href="{{ route('insurances.create') }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fa fa-lg fa-plus"></i>
                    @lang('insurances.new_insurance')
                </a>
                <a href="{{ route('insurances.edit', $insurance->id) }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fa fa-lg fa-edit"></i>
                    @lang('insurances.edit_insurance')
                </a>
                @endpermission
                <a href="{{ route('insurances.index') }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fas fa-lg fa-shield-alt"></i>
                    @lang('insurances.view_insurances')
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
                                    @if($insurance->image)
                                    <td colspan="6">
                                        <img src="{{ route('insurance.image', $insurance->id) }}?{{rand(0, 1000)}}"
                                            alt="@lang('insurances.image')" width="300px">
                                    </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td><b>@lang('insurances.name')</b></td>
                                    <td class="background_color">
                                        {{$insurance->name ?? ''}}
                                    </td>

                                    <td><b>@lang('insurances.solution_id')</b></td>
                                    <td class="background_color">
                                        {{$insurance->solution->name ?? ''}}
                                    </td>

                                    <td><b>@lang('insurances.icon')</b></td>
                                    <td class="background_color">
                                        <i class="{{ $insurance->icon }}"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>@lang('insurances.description')</b></td>
                                    <td class="background_color" colspan="6">
                                        {{$insurance->description ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>@lang('insurances.pre_content')</b></td>
                                    <td class="background_color" colspan="6">
                                        {!!$insurance->pre_content ?? ''!!}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>@lang('insurances.content')</b></td>
                                    <td class="background_color" colspan="6">
                                        {!!$insurance->content ?? ''!!}
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
                                        {{$insurance->created_at ?? ''}}
                                    </td>

                                    <td><b>@lang('base_lang.created_by_id')</b></td>
                                    <td class="background_color">
                                        {{$insurance->created_by->full_name ?? ''}}
                                    </td>

                                    @if ($insurance->updated_by_id)
                                    <td><b>@lang('base_lang.updated_at')</b></td>
                                    <td class="background_color">
                                        {{$insurance->updated_at ?? ''}}
                                    </td>

                                    <td><b>@lang('base_lang.updated_by_id')</b></td>
                                    <td class="background_color">
                                        {{$insurance->updated_by->full_name ?? ''}}
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