<?php


namespace AmirVahedix\Media\Services;


use AmirVahedix\Media\Contracts\MediaServiceContract;
use AmirVahedix\Media\Models\Media;
use Illuminate\Http\UploadedFile;

class MediaService
{
    private static $dir;
    private static $is_private;

    public static function privateUpload(UploadedFile $file)
    {
        self::$dir = "private";
        self::$is_private = true;
        return self::upload($file);
    }

    public static function publicUpload(UploadedFile $file)
    {
        self::$dir = "public";
        self::$is_private = false;
        return self::upload($file);
    }

    private static function upload($file)
    {
        $extension = self::getExtension($file);

        foreach (config('media.types') as $key => $type) {
            if (in_array($extension, $type['extensions'])) {
                return self::CreateMedia(resolve($type['handler']), $file, $key);
            }
        }

        return null;
    }

    public static function delete(Media $media)
    {
        switch ($media->type) {
            case 'image':
                ImageFileService::delete($media);
                break;
        }
    }

    private static function CreateMedia(MediaServiceContract $handler, UploadedFile $file, string $key)
    {
        return Media::create([
            'user_id' => auth()->id() ?? 1,
            'files' => json_encode(
                $handler::upload(
                    $file,
                    self::generateFilename(),
                    self::getExtension($file),
                    self::$dir
                )
            ),
            'type' => $key,
            'filename' => $file->getClientOriginalName(),
            'is_private' => self::$is_private
        ]);
    }

    private static function getExtension($file): string
    {
        return strtolower($file->getClientOriginalExtension());
    }

    private static function generateFilename()
    {
        return uniqid();
    }

}
