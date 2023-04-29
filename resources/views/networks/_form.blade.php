<form role="form" method="POST"
    action="{{ ($network->id ? route('networks.update', $network->id) : route('networks.store', $network->id)) }}"
    enctype="multipart/form-data">
    @csrf
    @if($network->id)
    @method('put')
    @endif
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <label>*@lang('networks.name')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-wifi"></i></div>
                    </div>
                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        name="name" value="{{ old('name', $network->name ?? '') }}"
                        placeholder="@lang('networks.name')">
                    @if($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-4">
                <label>*@lang('networks.link')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-link"></i></div>
                    </div>
                    <input id="link" type="text" class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}"
                        name="link" value="{{ old('link', $network->link ?? '') }}"
                        placeholder="@lang('networks.link')">
                    @if($errors->has('link'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('link') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-4">
                <label>*@lang('networks.icon')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="far fa-smile-beam"></i></div>
                    </div>
                    <input id="icon" type="text" class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }}"
                        name="icon" value="{{ old('icon', $network->icon ?? '') }}"
                        placeholder="@lang('networks.icon')">
                    @if($errors->has('icon'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('icon') }}</strong>
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
                <a href="{{ route('networks.index') }}" class="btn btn-sm btn-primary">
                    @lang('base_lang.cancel')
                </a>
            </div>
        </div>
    </div>
</form>