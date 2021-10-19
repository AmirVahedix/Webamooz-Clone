<?php


namespace AmirVahedix\Media\Services;


use AmirVahedix\Media\Contracts\MediaServiceContract;
use AmirVahedix\Media\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ZipFileService extends DefaultFileService implements MediaServiceContract
{
    public static function upload(UploadedFile $file, $filename, $extension, $dir): array
    {
        Storage::putFileAs($dir, $file, "$filename.$extension");
        return ["zip" => "$filename.$extension"];
    }

    public static function getFile($media)
    {
        return json_decode($media->files, true)['zip'];
    }
}
