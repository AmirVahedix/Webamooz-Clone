<?php


namespace AmirVahedix\Media\Services;


use AmirVahedix\Media\Contracts\MediaServiceContract;
use AmirVahedix\Media\Models\Media;
use Illuminate\Support\Facades\Storage;

class VideoFileService implements MediaServiceContract
{
    public static function upload($file, $filename, $extension, $dir) : array
    {
        Storage::putFileAs($dir, $file, "$filename.$extension");
        return ["video" => "$dir/$filename.$extension"];
    }

    public static function delete(Media $media)
    {

    }
}
