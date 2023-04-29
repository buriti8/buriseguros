<form role="form" method="POST"
    action="{{ ($solution->id ? route('solutions.update', $solution->id) : route('solutions.store', $solution->id)) }}"
    enctype="multipart/form-data">
    @csrf
    @if($solution->id)
    @method('put')
    @endif
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <label>*@lang('solutions.name')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        name="name" value="{{ old('name', $solution->name ?? '') }}"
                        placeholder="@lang('solutions.name')">
                    @if($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-4">
                <label>*@lang('solutions.image')</label>
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

            <div class="col-sm-12">
                <label>@lang('solutions.description')</label>
                <div class="input-group input-group-sm mb-2">
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        name="description" placeholder="@lang('solutions.description')"
                        rows="3">{{ old('description', $solution->description ?? '') }}</textarea>
                    @if($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
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
                <a href="{{ route('solutions.index') }}" class="btn btn-sm btn-primary">
                    @lang('base_lang.cancel')
                </a>
            </div>
        </div>
    </div>
</form>