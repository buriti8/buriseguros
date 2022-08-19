<form class="form-inline" action="{{ route('users.index') }}" method="get" role="search">
    <input type="hidden" name="per_page" value="{{$users->perPage()}}" />
    <div class="col-sm-12 col-lg-2">
        <label>@lang('users.full_name')</label>
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-user"></i></div>
            </div>
            <input type="text" class="form-control" name="q[full_name]" value="{{$search['full_name'] ?? ''}}"
                placeholder="@lang('users.full_name')" autocomplete="off">
        </div>
    </div>
    <div class="col-sm-12 col-lg-2">
        <label>@lang('users.email')</label>
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-envelope"></i></div>
            </div>
            <input type="text" class="form-control" name="q[email]" value="{{$search['email'] ?? ''}}"
                placeholder="@lang('users.email')" autocomplete="off">
        </div>
    </div>
    <div class="col-sm-12 col-lg-2">
        <label>@lang('users.username')</label>
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user-lock"></i></div>
            </div>
            <input type="text" class="form-control" name="q[username]" value="{{$search['username'] ?? ''}}"
                placeholder="@lang('users.username')" autocomplete="off">
        </div>
    </div>
    <div class="col-sm-12 col-lg-2">
        <label>@lang('users.role')</label>
        <div class="input-group input-group-sm mb-2">
            <select class="form-control-sm select2 w-100" name="q[role]">
                <option value="">@lang('users.role')</option>
                @foreach($roles as $r)
                <option value="{{$r->id}}" {{($search['role'] ?? '') == $r->id ? 'selected' : ''}}>
                    {{($r->name)}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-lg-2">
        <label>@lang('users.status')</label>
        <div class="input-group input-group-sm mb-2">
            <select class="form-control-sm select2 w-100" name="q[active]">
                <option value="">@lang('users.status')</option>
                <option value="1" {{($search['active'] ?? '') == '1' ? 'selected' : ''}}>@lang('base_lang.active')
                </option>
                <option value="0" {{($search['active'] ?? '') == '0' ? 'selected' : ''}}>@lang('base_lang.inactive')
                </option>
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-lg-2 mt-3">
        <button type="submit" class="btn btn-sm btn-primary mb-2">@lang('base_lang.search')</button>
        <a href="{{url('admin/users?q[]')}}" class="btn btn-sm btn-primary mb-2">
            @lang('base_lang.clear_search')
        </a>
    </div>
</form>