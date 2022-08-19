<div class="customer-group1 form-group">
    <label class="checkbox">
        <input type="hidden" name="synchronize" value="0" {{Auth::user()->is_admin ? '' : 'disabled'}}>
        <input type="checkbox" id="synchronize" name="synchronize"
               value="1" {{old('synchronize', $register_sync ?? false) ? 'checked' : ''}} {{Auth::user()->is_admin ? '' : 'disabled'}}>
        @lang('project_lang.synchronize')
        <i></i>
    </label>
</div>