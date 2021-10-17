<?php


namespace AmirVahedix\Media\Services;


use AmirVahedix\Media\Contracts\MediaServiceContract;
use AmirVahedix\Media\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ZipFileService implements MediaServiceContract
{
    public static function upload(UploadedFile $file, $filename, $extension, $dir): array
    {
        Storage::putFileAs($dir, $file, "$filename.$extension");
        return ["zip" => "$dir/$filename.$extension"];
    }

    public static function delete(Media $media)
    {

    }
}
