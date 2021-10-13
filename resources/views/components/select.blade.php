<div>
    <select name="{{ $name }}" class="custom-select" {{ $required ? 'required' : ''  }}>
        {{ $slot }}
    </select>

    <x-error name="{{ $name }}" />
</div>
