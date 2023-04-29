<table class="table table-sm table-bordered table-striped">
    <thead class="thead-gray">
        <tr>
            <th class="text-center">@lang('users.role')</th>
            <th class="text-center">@lang('users.permissions')</th>
            <th class="text-center">@lang('base_lang.delete')</th>
        </tr>
    </thead>

    @foreach($roles as $r)
    @if($r->name !== \Illuminate\Support\Str::upper(\App\Models\RoleBase::ADMIN))
    <tr role="row" class="odd" id="filaR_{{  $r->id }}">
        <td>{{ $r->name }}</td>
        <td class="text-center">
            <a type="submit" title="Asignar permisos" class="btn btn-sm btn-default btn-xs" href="{{url("/roles/{$r->id}/permissions")}}">
                <i class="fa fa-fw fa-key icon_color"></i>
            </a>
        </td>
        <td class="text-center">
            @if(in_array($r->name, $roles_base) !== true)
            <form class="form-horizontal" role="form" method="POST" action="{{url("/roles/{$r->id}")}}">
                @csrf
                @method('delete')
                <button type="button" class="btn btn-sm btn-default btn-xs btn-delete" title="Eliminar">
                    <i class="fa fa-fw fa-times delete"></i>
                </button>
            </form>
            @endif
        </td>
    </tr>
    @endif
    @endforeach
</table>