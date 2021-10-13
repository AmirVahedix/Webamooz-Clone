<?php


namespace AmirVahedix\Media\Services;


use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Monolog\Formatter\ElasticaFormatter;

class ImageFileService
{
    protected static $sizes = ['300', '600'];

    public static function upload($file)
    {
        $filename = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir = 'app/public';

        $file->move(storage_path($dir), "$filename.$extension");
        $path = "$dir/$filename.$extension";

        return self::resize($path, $dir, $filename, $extension);
    }

    private static function resize($image, $dir, $filename, $extension)
    {
        $image = Image::make(storage_path($image));
        $resized_images = [];
        $resized_images['original'] = "$filename.$extension";

        foreach (self::$sizes as $size) {
            $resized_images[$size] = "{$filename}_$size.$extension";
            $image->resize($size, null, function ($aspect) {
                $aspect->aspectRatio();
            })->save(storage_path("$dir/{$filename}_$size.$extension"));
        }

        return $resized_images;
    }
}
