@extends('layouts.menu')

@section('title', '| ' . __('base_lang.contacts') . ' - ' . __('base_lang.detail'))

@section('title_page')
<i class="fas fa-info"></i>&nbsp;@lang('base_lang.contacts')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.detail')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;{{$contact->name ?? ''}}

@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col col-12">@include('layouts.message')</div>
        <div class="col-12">
            <div class="button-w-100 mb-2">
                @permission(['edit_contacts', 'all_contacts'])
                <a href="{{ url('/admin/contacts/' . $contact->id . '/edit/') }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fa fa-fw fa-edit"></i>
                    @lang('contacts.edit_contact')
                </a>
                @endpermission
            </div>

            <div class="panel panel-default">
                <div class="panel-body body_form">
                    <div class="w-100 title-module">
                        @lang('base_lang.contacts')
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-active">
                            <tbody>
                                <tr>
                                    <td><b>@lang('contacts.name')</b></td>
                                    <td class="background_color">
                                        {{$contact->name ?? ''}}
                                    </td>
                                    <td><b>@lang('contacts.description')</b></td>
                                    <td class="background_color">
                                        {{$contact->description ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>@lang('contacts.phone')</b></td>
                                    <td class="background_color">
                                        {{$contact->phone ?? ''}}
                                    </td>
                                    <td><b>@lang('contacts.mobile')</b></td>
                                    <td class="background_color">
                                        {{$contact->mobile ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>@lang('contacts.email')</b></td>
                                    <td class="background_color">
                                        {{$contact->email ?? ''}}
                                    </td>
                                    <td><b>@lang('contacts.address')</b></td>
                                    <td class="background_color">
                                        {{$contact->address ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>@lang('contacts.image')</b></td>
                                    <td class="background_color" colspan="3">
                                        <img src="{{ route('contact.image', 1) }}?{{rand(0, 1000)}}" alt=""
                                            width="300" height="64">
                                    </td>
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