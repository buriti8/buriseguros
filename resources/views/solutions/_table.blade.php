<table class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center vertical-center"></th>
            <th class="text-center vertical-center">@lang('solutions.name')</th>

            @permission(['edit_solutions', 'all_solutions'])
            <th class="text-center vertical-center">@lang('base_lang.status')</th>
            <th class="text-center vertical-center">@lang('base_lang.edit')</th>
            @endpermission

            @permission(['delete_solutions', 'all_solutions'])
            <th class="text-center vertical-center">@lang('base_lang.delete')</th>
            @endpermission
        </tr>
    </thead>
    @forelse($solutions as $solution)
    <tr>
        <td class="text-center">
            <a href="{{ route('solutions.show', $solution->id) }}" class="btn btn-default btn-xs"
                title="@lang('base_lang.detail')">
                <i class="fa fa-fw fa-file-alt icon_color"></i>
            </a>
        </td>
        <td>{{ $solution->name ?? '' }}</td>

        @permission(['edit_solutions', 'all_solutions'])
        <td class="text-center">
            <form method="POST" action="{{ route('solutions.update', $solution->id) }}">
                @method('put')
                @csrf
                <input type="hidden" name="status" value="{{$solution->status ? 0 : 1}}" />
                <button type="button" class="btn btn-sm btn-primary btn-xs btn-status"
                    title="@lang('base_lang.status')">
                    {{$solution->status ? __('base_lang.disabled') : __('base_lang.enabled')}}
                </button>
            </form>
        </td>
        <td class="text-center">
            <div class="section_edit">
                <a href="{{ route('solutions.edit', $solution->id) }}" class="btn btn-sm btn-default btn-xs"
                    title="@lang('base_lang.edit')">
                    <i class="fa fa-fw fa-edit icon_color"></i>
                </a>
            </div>
        </td>
        @endpermission

        @permission(['delete_solutions', 'all_solutions'])
        <td class="text-center">
            <form class="form-horizontal" role="form" method="POST"
                action="{{route('solutions.destroy', $solution->id)}}">
                @method('delete')
                @csrf
                <button type="button" class="btn btn-sm  btn-default btn-xs btn-delete"
                    title="@lang('base_lang.delete') {{$solution->name}}">
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