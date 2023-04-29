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

                <div class="d-blok d-md-none card-header py-1 px-2" data-bs-toggle="collapse" href="#collapseSearching"
                    role="button" aria-expanded="false" aria-controls="collapseSearching">
                    <h3 class="card-title">@lang('base_lang.searching')</h3>
                    <i class="float-right fas fa-angle-down text-white"></i>
                </div>
                <div class="d-blok d-md-none collapse p-3" id="collapseSearching">
                    @include('users._search')
                </div>
            </div>

            <div class="pb-3">
                <a href="{{ url('/users/create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-lg fa-fw fa-plus"></i>&nbsp;@lang('users.new_user')
                </a>
                <a href="{{ url('/roles') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-lg fa-fw fa-crosshairs"></i>&nbsp;@lang('users.view_roles')
                </a>
            </div>
            @include('vendor.pagination.record-count', ['paginator' => $users, 'show_more_records' => false])
            <div class="table-responsive pt-3">
                <table class="table table-sm table-bordered table-striped">
                    <thead class="thead-gray">
                        <tr>
                            <th class="text-center vertical-center">@lang('users.full_name')</th>
                            <th class="text-center vertical-center">@lang('users.email')</th>
                            <th class="text-center vertical-center">@lang('users.username2')</th>
                            <th class="text-center vertical-center">@lang('users.roles')</th>
                            <th class="text-center vertical-center">@lang('users.status')</th>
                            <th class="text-center vertical-center">@lang('base_lang.edit')</th>
                            <th class="text-center vertical-center">@lang('base_lang.delete')</th>
                        </tr>
                    </thead>
                    @forelse($users as $u)
                    <tr>
                        <td>{{ $u->name . ' ' . $u->last_name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->username }}</td>
                        <td>{{ ucwords($u->getRoleNames()->implode(', ')) }}</td>
                        <td class="text-center">

                            @if($u->id !== \Illuminate\Support\Facades\Auth::user()->id && $u->id !== 1)
                            <form class="form-horizontal" role="form" method="POST"
                                action="{{url('/users/' . $u->id)}}">
                                @method('put')
                                @csrf
                                <input type="hidden" name="active" value="{{$u->active ? 0 : 1}}" />
                                @if($u->active)
                                <button type="button" class="btn btn-sm btn-primary btn-xs btn-inactive"
                                    title="@lang('base_lang.disabled')"> @lang('base_lang.disabled')</button>
                                @else
                                <button type="button" class="btn btn-sm btn-primary btn-xs btn-inactive"
                                    title="@lang('base_lang.enabled')"> @lang('base_lang.enabled')</button>
                                @endif
                            </form>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="section_edit">
                                <a href="{{url('/users/' . $u->id . '/edit')}}" class="btn btn-sm  btn-default btn-xs"
                                    title="@lang('base_lang.edit')"><i class="fa fa-fw fa-edit icon_color"></i></a>
                                <a href="{{url('users/' . $u->id . '/changePassword')}}"
                                    class="btn btn-sm  btn-default btn-xs" title="@lang('users.change_password')"><i
                                        class="fa fa-fw fa-lock icon_color"></i></a>
                            </div>
                        </td>

                        <td class="text-center">
                            @if($u->id !== \Illuminate\Support\Facades\Auth::user()->id && $u->id !== 1)
                            <form class="form-horizontal" role="form" method="POST"
                                action="{{url('/users/' . $u->id)}}">
                                @method('delete')
                                @csrf
                                <button type="button" class="btn btn-sm btn-default btn-xs btn-delete"
                                    title="@lang('base_lang.delete') {{$u->name}}">
                                    <i class="fa fa-fw fa-times delete"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <em>@lang('base_lang.no_records')</em>
                        </td>
                    </tr>
                    @endforelse
                </table>
            </div>
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection