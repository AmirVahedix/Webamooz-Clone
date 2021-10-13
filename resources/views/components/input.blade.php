<div>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            class="txt {{ isset($ltr) ? 'txt-l text-left' : '' }} @error($name) is-invalid @enderror {{ $class }}"
            value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
            autocomplete="{{ $autocomplete }}"
            {{ isset($autofocus) ? 'autofocus' : '' }}
            {{ isset($required) ? 'required' : '' }}
            {{ isset($readonly) ? 'readonly' : '' }} />

    <x-error name="{{ $name }}" />
</div>
