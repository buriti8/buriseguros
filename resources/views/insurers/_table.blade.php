<table class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center vertical-center"></th>
            <th class="text-center vertical-center">@lang('insurers.image')</th>
            <th class="text-center vertical-center">@lang('insurers.name')</th>
            <th class="text-center vertical-center">@lang('insurers.link')</th>

            @permission(['edit_insurers', 'all_insurers'])
            <th class="text-center vertical-center">@lang('base_lang.status')</th>
            <th class="text-center vertical-center">@lang('base_lang.edit')</th>
            @endpermission

            @permission(['delete_insurers', 'all_insurers'])
            <th class="text-center vertical-center">@lang('base_lang.delete')</th>
            @endpermission
        </tr>
    </thead>
    @forelse($insurers as $insurer)
    <tr>
        <td class="text-center">
            <a href="{{ route('insurers.show', $insurer->id) }}" class="btn btn-default btn-xs"
                title="@lang('base_lang.detail')">
                <i class="fa fa-fw fa-file-alt icon_color"></i>
            </a>
        </td>
        <td class="text-center">
            <div class="container d-flex h-100">
                <div class="row justify-content-center align-self-center">
                    <img alt="" @if ($insurer->image)
                    src="{{ route('insurer.image', $insurer->id) }}?{{rand(0, 1000)}}"
                    @else
                    src="{{ asset('img/logo.png') }}"
                    @endif>
                </div>
            </div>
        </td>
        <td>{{ $insurer->name ?? '' }}</td>
        <td>
            <a href="{{ $insurer->link ?? '' }}" target="_blank">
                {{ $insurer->link ?? '' }}
            </a>
        </td>

        @permission(['edit_insurers', 'all_insurers'])
        <td class="text-center">
            <form method="POST" action="{{ route('insurers.update', $insurer->id) }}">
                @method('put')
                @csrf
                <input type="hidden" name="status" value="{{$insurer->status ? 0 : 1}}" />
                <button type="button" class="btn btn-sm btn-primary btn-xs btn-status"
                    title="@lang('base_lang.status')">
                    {{$insurer->status ? __('base_lang.disabled') : __('base_lang.enabled')}}
                </button>
            </form>
        </td>
        <td class="text-center">
            <div class="section_edit">
                <a href="{{ route('insurers.edit', $insurer->id) }}" class="btn btn-sm btn-default btn-xs"
                    title="@lang('base_lang.edit')">
                    <i class="fa fa-fw fa-edit icon_color"></i>
                </a>
            </div>
        </td>
        @endpermission

        @permission(['delete_insurers', 'all_insurers'])
        <td class="text-center">
            <form class="form-horizontal" role="form" method="POST"
                action="{{route('insurers.destroy', $insurer->id)}}">
                @method('delete')
                @csrf
                <button type="button" class="btn btn-sm  btn-default btn-xs btn-delete"
                    title="@lang('base_lang.delete') {{$insurer->name}}">
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