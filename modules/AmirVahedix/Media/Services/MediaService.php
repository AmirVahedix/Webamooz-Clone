<?php


namespace AmirVahedix\Media\Services;


use AmirVahedix\Media\Models\Media;

class MediaService
{
    public static function upload($file)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        switch ($extension) {
            case 'jpg':
            case 'png':
            case 'jpeg':
                return Media::create([
                    'user_id' => auth()->id(),
                    'files' => json_encode(ImageFileService::upload($file)),
                    'type' => 'image',
                    'filename' => $file->getClientOriginalName()
                ]);
            case 'zip':
            case 'rar':
            case 'tar':
                ZipFileService::upload($file);
                break;
            case 'avi':
            case 'mp4':
            case 'mpeg':
            case 'mkv':
                VideoFileService::upload($file);
                break;
        }
    }

    public static function delete(Media $media)
    {
        switch ($media->type) {
            case 'image':
                ImageFileService::delete($media);
                break;
        }
    }
}
