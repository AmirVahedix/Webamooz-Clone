<label class="ui-checkbox">
    <input type="checkbox" name="{{ $name }}" value="{{ $value }}" {{ $checked ? 'checked' : '' }}>
    <span class="checkbox__label">{{ $title }}</span>
    <span class="checkmark"></span>
</label>
