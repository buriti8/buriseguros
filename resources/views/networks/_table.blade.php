<table class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center vertical-center"></th>
            <th class="text-center vertical-center">@lang('networks.name')</th>
            <th class="text-center vertical-center">@lang('networks.link')</th>
            <th class="text-center vertical-center">@lang('networks.icon')</th>

            @permission(['edit_networks', 'all_networks'])
            <th class="text-center vertical-center">@lang('base_lang.status')</th>
            <th class="text-center vertical-center">@lang('base_lang.edit')</th>
            @endpermission

            @permission(['delete_networks', 'all_networks'])
            <th class="text-center vertical-center">@lang('base_lang.delete')</th>
            @endpermission
        </tr>
    </thead>
    @forelse($networks as $network)
    <tr>
        <td class="text-center">
            <a href="{{ route('networks.show', $network->id) }}" class="btn btn-default btn-xs"
                title="@lang('base_lang.detail')">
                <i class="fa fa-fw fa-file-alt icon_color"></i>
            </a>
        </td>
        <td>{{ $network->name ?? '' }}</td>
        <td>
            <a href="{{ $network->link ?? '' }}" target="_blank">
                {{ $network->link ?? '' }}
            </a>
        </td>
        <td><i class="{{ $network->icon }}"></i></td>

        @permission(['edit_networks', 'all_networks'])
        <td class="text-center">
            <form method="POST" action="{{ route('networks.update', $network->id) }}">
                @method('put')
                @csrf
                <input type="hidden" name="status" value="{{$network->status ? 0 : 1}}" />
                <button type="button" class="btn btn-sm btn-primary btn-xs btn-status"
                    title="@lang('base_lang.status')">
                    {{$network->status ? __('base_lang.disabled') : __('base_lang.enabled')}}
                </button>
            </form>
        </td>
        <td class="text-center">
            <div class="section_edit">
                <a href="{{ route('networks.edit', $network->id) }}" class="btn btn-sm btn-default btn-xs"
                    title="@lang('base_lang.edit')">
                    <i class="fa fa-fw fa-edit icon_color"></i>
                </a>
            </div>
        </td>
        @endpermission

        @permission(['delete_networks', 'all_networks'])
        <td class="text-center">
            <form class="form-horizontal" role="form" method="POST"
                action="{{route('networks.destroy', $network->id)}}">
                @method('delete')
                @csrf
                <button type="button" class="btn btn-sm  btn-default btn-xs btn-delete"
                    title="@lang('base_lang.delete') {{$network->name}}">
                    <i class="fa fa-fw fa-times delete"></i>
                </button>
            </form>
        </td>
        @endpermission
    </tr>
    @empty
    <tr>
        <td colspan="11">
            <em>@lang('base_lang.no_records')</em>
        </td>
    </tr>
    @endforelse
</table>