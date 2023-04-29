<form role="form" method="POST" action="{{ ($information->id ? route('information.update', $information->id) : '') }}"
    enctype="multipart/form-data">
    @csrf
    @if($information->id)
    @method('put')
    @endif
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <label>*@lang('information.name')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-info"></i></div>
                    </div>
                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        name="name" value="{{ old('name', $information->name ?? '') }}"
                        placeholder="@lang('information.name')">
                    @if($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <label>*@lang('information.phone')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-phone-alt"></i></div>
                    </div>
                    <input id="phone" type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                        name="phone" value="{{ old('phone', $information->phone ?? '') }}"
                        placeholder="@lang('information.phone')">
                    @if($errors->has('phone'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <label>*@lang('information.mobile')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-mobile-alt"></i></div>
                    </div>
                    <input id="mobile" type="text" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}"
                        name="mobile" value="{{ old('mobile', $information->mobile ?? '') }}"
                        placeholder="@lang('information.mobile')">
                    @if($errors->has('mobile'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('mobile') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <label>*@lang('information.email')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                    </div>
                    <input id="email" type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        name="email" value="{{ old('email', $information->email ?? '') }}"
                        placeholder="@lang('information.email')">
                    @if($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <label>*@lang('information.address')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-map-marker"></i></div>
                    </div>
                    <input id="address" type="text"
                        class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address"
                        value="{{ old('address', $information->address ?? '') }}"
                        placeholder="@lang('information.address')">
                    @if($errors->has('address'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <label>@lang('information.description')</label>
                <div class="input-group input-group-sm mb-2">
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        name="description" placeholder="@lang('information.description')"
                        rows="3">{{ old('description', $information->description ?? '') }}</textarea>
                    @if($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <label>*@lang('information.image')</label>
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
                <a href="{{ route('information.show', $information->id) }}" class="btn btn-sm btn-primary">
                    @lang('base_lang.cancel')
                </a>
            </div>
        </div>
    </div>
</form>