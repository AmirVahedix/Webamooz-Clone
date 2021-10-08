<div>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            class="txt @error('{{ $name }}') is-invalid @enderror {{ $class }}"
            value="{{ old($name) }}" placeholder="{{ $placeholder }}"
            autocomplete="{{ $autocomplete }}"
            {{ isset($autofocus) ? 'autofocus' : '' }}
            {{ isset($required) ? 'required' : '' }} >

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
