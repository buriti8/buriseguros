<table class="table table-sm table-bordered table-striped text-nowrap">
    <thead>
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
        <td>{{ $u->getRoleNames()->implode(', ') }}</td>
        <td class="text-center">

            @if($u->id !== \Illuminate\Support\Facades\Auth::user()->id && $u->id !== 1)
            <form class="form-horizontal" role="form" method="POST" action="{{route('users.update', $u->id)}}">
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
                <a href="{{route('users.edit', $u->id)}}" class="btn btn-sm  btn-default btn-xs"
                    title="@lang('base_lang.edit')"><i class="fa fa-fw fa-edit icon_color"></i></a>
                <a href="{{url('admin/users/' . $u->id . '/changePassword')}}" class="btn btn-sm  btn-default btn-xs"
                    title="@lang('users.change_password')">
                    <i class="fa fa-fw fa-lock icon_color"></i>
                </a>
            </div>
        </td>

        <td class="text-center">
            @if($u->id !== \Illuminate\Support\Facades\Auth::user()->id && $u->id !== 1)
            <form class="form-horizontal" role="form" method="POST" action="{{route('users.destroy', $u->id)}}">
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