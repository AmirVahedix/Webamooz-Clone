<?php


namespace AmirVahedix\Media\Services;


use AmirVahedix\Media\Contracts\MediaServiceContract;
use AmirVahedix\Media\Models\Media;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Monolog\Formatter\ElasticaFormatter;

class ImageFileService extends DefaultFileService implements MediaServiceContract
{
    protected static $sizes = ['300', '600'];

    public static function upload($file, $filename, $extension, $dir): array
    {
        Storage::putFileAs($dir, $file, "$filename.$extension");
        $path = "$dir/$filename.$extension";

        return self::resize($path, $dir, $filename, $extension);
    }

    private static function resize($image, $dir, $filename, $extension): array
    {
        $image = Image::make(Storage::path($image));
        $resized_images = [];
        $resized_images['original'] = "$filename.$extension";

        foreach (self::$sizes as $size) {
            $resized_images[$size] = "{$filename}_$size.$extension";
            $image->resize($size, null, function ($aspect) {
                $aspect->aspectRatio();
            })->save(Storage::path("$dir/{$filename}_$size.$extension"));
        }


        return $resized_images;
    }

}
