<table class="table table-sm table-bordered table-striped">
    <thead class="thead-gray">
        <tr>
            <th class="text-center">@lang('lists.list')</th>
            <th class="text-center">@lang('lists.option')</th>
            <th class="text-center">@lang('lists.option_key')</th>
            @permission(['edit_lists', 'all_lists'])
            <th class="text-center">@lang('lists.status')</th>
            <th class="text-center">@lang('base_lang.edit')</th>
            @endpermission
        </tr>
    </thead>

    @forelse($lists_options as $o)
    <tr role="row" class="odd">
        <td>{{$lists[$o->list] ?? ''}}</td>
        <td>{{$o->option}}</td>
        <td>{{$o->option_key}}</td>
        @permission(['edit_lists', 'all_lists'])
        <td class="text-center">
            @if(!isset($protected[$o->list]) || !isset($protected[$o->list][$o->option_key]))
            <form action="{{url("/lists/{$o->id}")}}" method="post">
                @csrf
                @method('put')
                <input type="hidden" name="status" value="{{$o->status ? 0 : 1}}" />
                <button type="button" class="btn btn-primary btn-xs btn-status">
                    {{$o->status ? __('base_lang.disabled') : __('base_lang.enabled')}}
                </button>
            </form>
            @endif
        </td>
        <td class="text-center">
            @if(!isset($protected[$o->list]) || !isset($protected[$o->list][$o->option_key]))
            <a href="{{url("/lists/{$o->id}/edit")}}" class="btn btn-sm btn-default btn-xs" title="Editar"><i
                    class="fa fa-fw fa-edit"></i>
            </a>
            @endif
        </td>
        @endpermission
    </tr>
    @empty
    <tr>
        <td colspan="5">
            <em>@lang('base_lang.no_records')</em>
        </td>
    </tr>
    @endforelse
</table>