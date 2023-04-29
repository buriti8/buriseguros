@extends('layouts.menu')

@section('title', __('base_lang.solutions') . ' - ' . __('base_lang.detail'))

@section('title_page')
<i class="fas fa-lock"></i></i>&nbsp;@lang('base_lang.solutions')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.detail')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;{{$solution->name ?? ''}}
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col col-12">@include('layouts.message')</div>
        <div class="col-12">
            <div class="button-w-100 mb-2">
                @permission(['edit_solutions', 'all_solutions'])
                <a href="{{ route('solutions.create') }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fa fa-lg fa-plus"></i>
                    @lang('solutions.new_solution')
                </a>
                <a href="{{ route('solutions.edit', $solution->id) }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fa fa-lg fa-edit"></i>
                    @lang('solutions.edit_solution')
                </a>
                @endpermission
                <a href="{{ route('solutions.index') }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fas fa-lg fa-lock"></i>
                    @lang('solutions.view_solutions')
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
                                    @if($solution->image)
                                    <td colspan="2">
                                        <img src="{{ route('solution.image', $solution->id) }}?{{rand(0, 1000)}}"
                                            alt="@lang('solutions.image')">
                                    </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td><b>@lang('solutions.name')</b></td>
                                    <td class="background_color">
                                        {{$solution->name ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>@lang('solutions.description')</b></td>
                                    <td class="background_color">
                                        {{$solution->description ?? ''}}
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
                                        {{$solution->created_at ?? ''}}
                                    </td>

                                    <td><b>@lang('base_lang.created_by_id')</b></td>
                                    <td class="background_color">
                                        {{$solution->created_by->full_name ?? ''}}
                                    </td>

                                    @if ($solution->updated_by_id)
                                    <td><b>@lang('base_lang.updated_at')</b></td>
                                    <td class="background_color">
                                        {{$solution->updated_at ?? ''}}
                                    </td>

                                    <td><b>@lang('base_lang.updated_by_id')</b></td>
                                    <td class="background_color">
                                        {{$solution->updated_by->full_name ?? ''}}
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