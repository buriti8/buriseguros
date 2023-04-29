@extends('layouts.menu')

@section('title', __('users.permissions'))

@section('title_page')
<i class="fa fa-crosshairs"></i>&nbsp;@lang('users.permissions')
<i class="fas fa-caret-right pl-1 pr-1"></i> {{ucwords(mb_strtolower($role->name))}}
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row">
        <div class="col col-12">@include('layouts.message')</div>
        <div class="col-md-12">
            <div class="pb-3">
                <a href="{{ url('/users/create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-lg fa-fw fa-plus"></i>&nbsp;@lang('users.new_user')
                </a>
                <a href="{{ url('users') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-lg fa-fw fa-users"></i>&nbsp;@lang('users.view_user')
                </a>
                <a href="{{ url('/roles') }}" class="btn btn-sm btn-primary "><i
                        class="fa fa-lg fa-fw fa-crosshairs "></i>&nbsp;@lang('users.view_roles')
                </a>
            </div>
            <div class="panel panel-default">
                <div class="panel-body body_form">
                    <div class="card card-secondary mb-2">
                        <div class="card-header py-1 px-2">
                            <h3 class="card-title">@lang('base_lang.permission_by_modules')</h3>
                        </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{url("/roles/{$role->
                            id}/permissions")}}" id='save_form'>
                            @csrf
                            <div class="row">
                                <section class="col col-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered table-striped">
                                            <tr class="background_color">
                                                <th style="text-align: center">
                                                    @lang('base_lang.module')
                                                </th>

                                                @foreach($permissions as $perm =>$p)
                                                <th style="text-align: center">{{ $p }}</th>
                                                @endforeach
                                            </tr>
                                            @foreach($modules as $mod =>$m)
                                            <tr role="row" class="odd" id="">
                                                <td>{{ $m }}</td>

                                                @foreach($permissions as $perm =>$p)
                                                <?php $name_permission = $perm . '_' . $mod; ?>
                                                <td style="text-align: center">
                                                    <input type="checkbox" id="{{$name_permission}}"
                                                        name="{{$name_permission}}" value="1"
                                                        {{$role->hasPermissionTo($name_permission) ? 'checked' : ''}}>
                                                </td>
                                                @endforeach
                                            </tr>
                                            @endforeach

                                        </table>
                                    </div>
                                </section>
                            </div>
                            <div class="row pb-3">
                                <div class="col col-12 text-right">
                                    <section class="col col-12">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            @lang('base_lang.save')
                                        </button>
                                        <a href="{{ url('/roles') }}"
                                            class="btn btn-sm btn-primary">@lang('base_lang.cancel')</a>
                                    </section>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection