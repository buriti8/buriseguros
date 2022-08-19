<form class="form-inline" action="{{ route('solutions.index') }}" method="get" role="search">
    <input type="hidden" name="per_page" value="{{$solutions->perPage()}}" />
    <div class="col-sm-12 col-lg-4">
        <label>@lang('solutions.name')</label>
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <input type="text" class="form-control" name="q[name]" value="{{$search['name'] ?? ''}}"
                placeholder="@lang('solutions.name')" autocomplete="off">
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <label>@lang('users.status')</label>
        <div class="input-group input-group-sm mb-2">
            <select class="form-control-sm select2 w-100" name="q[status]">
                <option value="">@lang('users.status')</option>
                <option value="1" {{($search['active'] ?? '') == '1' ? 'selected' : ''}}>@lang('base_lang.active')
                </option>
                <option value="0" {{($search['active'] ?? '') == '0' ? 'selected' : ''}}>@lang('base_lang.inactive')
                </option>
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4 mt-3">
        <button type="submit" class="btn btn-sm btn-primary mb-2">@lang('base_lang.search')</button>
        <a href="{{url('admin/solutions?q[]')}}" class="btn btn-sm btn-primary mb-2">
            @lang('base_lang.clear_search')
        </a>
    </div>
</form>