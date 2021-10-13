<div class="file-upload">
    <div class="i-file-upload">
        <span>{{ $label }}</span>
        <input name="{{ $name }}" type="file" class="file-upload" />
    </div>
    <span class="filesize"></span>
    <span class="selectedFiles">فایلی انتخاب نشده است</span>

    <x-error name="{{ $name }}" />
</div>
