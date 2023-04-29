<form class="form-inline" action="{{ url('users') }}" method="get" role="search">
    <input type="hidden" name="per_page" value="{{$users->perPage()}}" />

    <div class="col-sm-12 col-md-3">
        <label>@lang('users.search_name')</label>
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-user"></i></div>
            </div>
            <input type="text" class="form-control" id="entry" name="q[entry]" placeholder="@lang('users.search_name')"
                value="{{$search['entry'] ?? ''}}">
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <label>@lang('users.role')</label>
        <div class="input-group input-group mb-2">
            <select class="form-control-sm select2 w-100" name="q[role]">
                <option value="">@lang('users.role')</option>
                @foreach($roles as $r)
                <option value="{{$r->id}}" {{($search['role'] ?? '') == $r->id ? 'selected' : ''}}>
                    {{($r->name)}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <label>@lang('users.status')</label>
        <div class="input-group input-group-sm mb-2">
            <select class="form-control-sm select2 w-100" name="q[status]">
                <option value="">@lang('users.status')</option>
                <option value="1" {{($search['status'] ?? '') == '1' ? 'selected' : ''}}>@lang('base_lang.active')
                </option>
                <option value="0" {{($search['status'] ?? '') == '0' ? 'selected' : ''}}>@lang('base_lang.inactive')
                </option>
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <label>&nbsp;</label>
        <button type="submit" class="btn btn-sm btn-primary mb-2">@lang('base_lang.search')</button>
        <a href="{{url('users?q')}}" class="btn btn-sm btn-primary mb-2">
            @lang('base_lang.clear_search')
        </a>
    </div>
</form>