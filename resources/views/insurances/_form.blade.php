<form role="form" method="POST"
    action="{{ ($insurance->id ? route('insurances.update', $insurance->id) : route('insurances.store', $insurance->id)) }}"
    enctype="multipart/form-data">
    @csrf
    @if($insurance->id)
    @method('put')
    @endif
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <label>*@lang('insurances.name')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-shield-alt"></i></div>
                    </div>
                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        name="name" value="{{ old('name', $insurance->name ?? '') }}"
                        placeholder="@lang('insurances.name')">
                    @if($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <label>*@lang('insurances.solution_id')</label>
                <div class="input-group input-group-sm mb-2 {{ $errors->has('solution_id') ? 'has-error' : '' }}">
                    <select class="form-control-sm select2 {{ $errors->has('solution_id') ? 'is-invalid' : '' }} w-100"
                        name="solution_id" id="solution_id">
                        <option value="">@lang('insurances.select_solution')</option>
                        @foreach($solutions as $solution)
                        <option value="{{$solution->id}}"
                            {{ $solution->id==old('solution_id', $insurance->solution_id ?? '') ? 'selected' : '' }}>
                            {{ $solution->name }}
                        </option>
                        @endforeach
                    </select>
                    @if($errors->has('solution_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('solution_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <label>*@lang('insurances.image')</label>
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
            <div class="col-sm-12 col-md-3">
                <label>*@lang('insurances.icon')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="far fa-smile-beam"></i></div>
                    </div>
                    <input id="icon" type="text" class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }}"
                        name="icon" value="{{ old('icon', $insurance->icon ?? '') }}"
                        placeholder="@lang('insurances.icon')">
                    @if($errors->has('icon'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('icon') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <label>*@lang('insurances.description')</label>
                <div class="input-group input-group-sm mb-2">
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        name="description" placeholder="@lang('insurances.description')"
                        rows="2">{{ old('description', $insurance->description ?? '') }}</textarea>
                    @if($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <label>*@lang('insurances.pre_content')</label>
                <div class="input-group input-group-sm mb-2">
                    <textarea class="form-control {{ $errors->has('pre_content') ? 'is-invalid' : '' }}" name="pre_content"
                        placeholder="@lang('insurances.pre_content')"
                        rows="10">{{ old('pre_content', $insurance->pre_content ?? '') }}</textarea>
                    @if($errors->has('pre_content'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('pre_content') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <label>*@lang('insurances.content')</label>
                <div class="input-group input-group-sm mb-2">
                    <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"
                        placeholder="@lang('insurances.content')"
                        rows="10">{{ old('content', $insurance->content ?? '') }}</textarea>
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
                <a href="{{ route('insurances.index') }}" class="btn btn-sm btn-primary">
                    @lang('base_lang.cancel')
                </a>
            </div>
        </div>
    </div>
</form>