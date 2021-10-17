<?php


namespace AmirVahedix\Media\Services;


use AmirVahedix\Media\Models\Media;
use Illuminate\Support\Facades\Storage;

class DefaultFileService
{
    public static function delete(Media $media)
    {
        $dir = $media->is_private ? 'private' : 'public';

        foreach (json_decode($media->files) as $file) {
            Storage::delete("$dir\\$file");
        }
    }
}
