<form role="form" method="POST" action="{{ url('/admin/posts' . ($posts->id ? "/{$posts->id}" : '')) }}"
    enctype="multipart/form-data">
    @csrf
    @if($posts->id)
    @method('put')
    @endif
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <label>*@lang('posts.title')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-text-height"></i></div>
                    </div>
                    <input id="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                        name="title" value="{{ old('title', $posts->title ?? '') }}" placeholder="@lang('posts.title')">
                    @if($errors->has('title'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <label>*@lang('posts.description')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-spell-check"></i></div>
                    </div>
                    <input id="description" type="text"
                        class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                        value="{{ old('description', $posts->description ?? '') }}"
                        placeholder="@lang('posts.description')">
                    @if($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <label>*@lang('posts.image')</label>
                <div class="form-group">
                    <div class="custom-file">
                        <input id="image" type="file" lang="es" name="image"
                            class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }} custom-file-input">
                        <label for="image" class="custom-file-label">
                            @lang('base_lang.select_file')
                        </label>
                        @if($errors->has('image'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                        @endif
                    </div>
                    <small class="form-text">@lang('base_lang.image_rules')</small>
                </div>
            </div>
            <div class="col-sm-6">
                <label>*@lang('posts.category_id')</label>
                <div class="input-group input-group-sm mb-2 {{ $errors->has('category_id') ? 'has-error' : '' }}">
                    <select class="form-control-sm select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }} w-100"
                        name="category_id" id="category_id">
                        <option value="">@lang('posts.select_category_posts')</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}"
                            {{ $category->id==old('category_id', $posts->category_id ?? '') ? 'selected' : '' }}>
                            {{ $category->option }}
                        </option>
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('category_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <label>@lang('posts.content')</label>
                <div class="input-group input-group-sm mb-2">
                    <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"
                        placeholder="@lang('posts.content')"
                        rows="10">{{ old('content', $posts->content ?? '') }}</textarea>
                    @if($errors->has('content'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-5">
                <small><strong>(*) </strong>@lang('base_lang.required')</small>
            </div>
            <div class="col-sm-12 col-md-7 text-center text-md-right pt-2">
                <button type="submit" class="btn btn-sm btn-primary">
                    @lang('base_lang.save')
                </button>
                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-primary">
                    @lang('base_lang.cancel')
                </a>
            </div>
        </div>
    </div>
</form>