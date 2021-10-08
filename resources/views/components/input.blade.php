<div>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            class="txt {{ isset($ltr) ? 'txt-l' : '' }} @error($name) is-invalid @enderror {{ $class }}"
            value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
            autocomplete="{{ $autocomplete }}"
            {{ isset($autofocus) ? 'autofocus' : '' }}
            {{ isset($required) ? 'required' : '' }}
            {{ isset($readonly) ? 'readonly' : '' }} >

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
