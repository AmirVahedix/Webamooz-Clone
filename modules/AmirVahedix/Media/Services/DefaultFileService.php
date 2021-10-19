<?php


namespace AmirVahedix\Media\Services;


use AmirVahedix\Media\Models\Media;
use Illuminate\Support\Facades\Storage;

abstract class DefaultFileService
{
    public static function delete(Media $media)
    {
        $dir = $media->is_private ? 'private' : 'public';

        foreach (json_decode($media->files) as $file) {
            Storage::delete("$dir\\$file");
        }
    }

    abstract static function getFile($media);

    public static function stream(Media $media)
    {
        $disk = $media->is_private ? "private" : "public";
        $file = static::getFile($media);
        $stream = Storage::disk($disk)->readStream($file);

        return response()->stream(
            function () use ($stream) {
                while (ob_get_level() > 0) ob_get_flush();
                fpassthru($stream);
            },
            200,
            [
                "Content-Type" => Storage::disk($disk)->mimeType($file),
                "Content-disposition" => "attachment; filename=$file`"
            ]
        );
    }
}
