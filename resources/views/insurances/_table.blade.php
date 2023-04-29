<table class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center vertical-center"></th>
            <th class="text-center vertical-center">@lang('insurances.name')</th>
            <th class="text-center vertical-center">@lang('insurances.solution_id')</th>

            @permission(['edit_insurances', 'all_insurances'])
            <th class="text-center vertical-center">@lang('base_lang.status')</th>
            <th class="text-center vertical-center">@lang('base_lang.edit')</th>
            @endpermission

            @permission(['delete_insurances', 'all_insurances'])
            <th class="text-center vertical-center">@lang('base_lang.delete')</th>
            @endpermission
        </tr>
    </thead>
    @forelse($insurances as $insurance)
    <tr>
        <td class="text-center">
            <a href="{{ route('insurances.show', $insurance->id) }}" class="btn btn-default btn-xs"
                title="@lang('base_lang.detail')">
                <i class="fa fa-fw fa-file-alt icon_color"></i>
            </a>
        </td>
        <td>{{ $insurance->name ?? '' }}</td>
        <td>{{ $insurance->solution->name ?? '' }}</td>

        @permission(['edit_insurances', 'all_insurances'])
        <td class="text-center">
            <form method="POST" action="{{ route('insurances.update', $insurance->id) }}">
                @method('put')
                @csrf
                <input type="hidden" name="status" value="{{$insurance->status ? 0 : 1}}" />
                <button type="button" class="btn btn-sm btn-primary btn-xs btn-status"
                    title="@lang('base_lang.status')">
                    {{$insurance->status ? __('base_lang.disabled') : __('base_lang.enabled')}}
                </button>
            </form>
        </td>
        <td class="text-center">
            <div class="section_edit">
                <a href="{{ route('insurances.edit', $insurance->id) }}" class="btn btn-sm btn-default btn-xs"
                    title="@lang('base_lang.edit')">
                    <i class="fa fa-fw fa-edit icon_color"></i>
                </a>
            </div>
        </td>
        @endpermission

        @permission(['delete_insurances', 'all_insurances'])
        <td class="text-center">
            <form class="form-horizontal" role="form" method="POST"
                action="{{route('insurances.destroy', $insurance->id)}}">
                @method('delete')
                @csrf
                <button type="button" class="btn btn-sm  btn-default btn-xs btn-delete"
                    title="@lang('base_lang.delete') {{$insurance->name}}">
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