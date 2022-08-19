<form class="form-inline" action="{{url('admin/lists')}}" method="get" role="search">
    <input type="hidden" name="per_page" value="{{$lists_options->perPage()}}" />
    <div class="col-md-3">
        <div class="input-group input-group-sm mb-2">
            <select name="q[list]" class="form-control-sm select2 w-100" id="list">
                <option value="">@lang('lists.list')</option>
                @foreach($lists as $li => $l)
                <option value="{{$li}}" {{($search['list'] ?? '') == $li ? 'selected' : ''}}>{{$l}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-th-list"></i></div>
            </div>
            <input type="text" class="form-control broadness" id="search" name="q[option]"
                placeholder="@lang('lists.option')" value="{{$search['option'] ?? ''}}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-hashtag"></i></div>
            </div>
            <input type="text" class="form-control broadness" id="search" name="q[option_key]"
                placeholder="@lang('lists.option_key')" value="{{$search['option_key'] ?? ''}}">
        </div>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-sm btn-primary mb-2">@lang('base_lang.search')</button>
        <a href="{{url('admin/lists?q[]')}}" class="btn btn-sm btn-primary mb-2">
            @lang('base_lang.clear_search')
        </a>
    </div>
</form>