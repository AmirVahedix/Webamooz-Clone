<?php


namespace AmirVahedix\Media\Contracts;


use AmirVahedix\Media\Models\Media;
use Illuminate\Http\UploadedFile;

interface MediaServiceContract
{
    public static function upload(
        UploadedFile $file,
        string $filename,
        string $extension,
        string $dir
    ): array;

    public static function delete(Media $media);

    public static function stream(Media $media);
}
