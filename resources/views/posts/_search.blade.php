<form class="form-inline" action="{{ route('posts.index') }}" method="get" role="search">
    <input type="hidden" name="per_page" value="{{$posts->perPage()}}" />
    <div class="col-sm-12 col-md-3">
        <label>@lang('posts.title')</label>
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-text-height"></i></div>
            </div>
            <input type="text" class="form-control" name="q[title]" value="{{$search['title'] ?? ''}}"
                placeholder="@lang('posts.title')" autocomplete="off">
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <label>@lang('posts.category_id')</label>
        <div class="input-group input-group-sm mb-2">
            <select class="form-control-sm select2" name="q[category_id]">
                <option value="">@lang('posts.select_category_posts')</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}" {{($search['category_id'] ?? '') == $category->id ? 'selected' : ''}}>
                    {{$category->option}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <label>@lang('posts.created_at')</label>
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
            </div>
            <input type="text" class="form-control datepicker" name="q[created_at]"
                value="{{$search['created_at'] ?? ''}}" placeholder="@lang('posts.created_at')"
                data-date-format="{{config('app.js_date_format')}}" autocomplete="off">
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
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
    <div class="col-sm-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary mb-2">@lang('base_lang.search')</button>
        <a href="{{url('admin/posts?q[]')}}" class="btn btn-sm btn-primary mb-2">
            @lang('base_lang.clear_search')
        </a>
    </div>
</form>