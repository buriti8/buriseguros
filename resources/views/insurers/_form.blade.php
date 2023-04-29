<form role="form" method="POST"
    action="{{ ($insurer->id ? route('insurers.update', $insurer->id) : route('insurers.store', $insurer->id)) }}"
    enctype="multipart/form-data">
    @csrf
    @if($insurer->id)
    @method('put')
    @endif
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <label>*@lang('insurers.name')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-briefcase"></i></div>
                    </div>
                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        name="name" value="{{ old('name', $insurer->name ?? '') }}"
                        placeholder="@lang('insurers.name')">
                    @if($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-4">
                <label>*@lang('insurers.link')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-link"></i></div>
                    </div>
                    <input id="link" type="text" class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}"
                        name="link" value="{{ old('link', $insurer->link ?? '') }}"
                        placeholder="@lang('insurers.link')">
                    @if($errors->has('link'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('link') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-4">
                <label>*@lang('insurers.image')</label>
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
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-5">
                <small><strong>(*) </strong>@lang('base_lang.required')</small>
            </div>
            <div class="col-sm-12 col-md-7 text-center text-md-right pt-2">
                <button type="submit" class="btn btn-sm btn-primary">
                    @lang('base_lang.save')
                </button>
                <a href="{{ route('insurers.index') }}" class="btn btn-sm btn-primary">
                    @lang('base_lang.cancel')
                </a>
            </div>
        </div>
    </div>
</form>