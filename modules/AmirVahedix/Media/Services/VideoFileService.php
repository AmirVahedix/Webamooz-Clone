<?php


namespace AmirVahedix\Media\Services;


use AmirVahedix\Media\Contracts\MediaServiceContract;
use AmirVahedix\Media\Models\Media;
use Illuminate\Support\Facades\Storage;

class VideoFileService extends DefaultFileService implements MediaServiceContract
{
    public static function upload($file, $filename, $extension, $dir) : array
    {
        Storage::putFileAs($dir, $file, "$filename.$extension");
        return ["video" => "$filename.$extension"];
    }

    public static function getFile($media)
    {
        return json_decode($media->files, true)['video'];
    }
}
