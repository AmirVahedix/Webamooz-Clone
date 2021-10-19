<?php


namespace AmirVahedix\Media\Http\Controllers;


use AmirVahedix\Media\Models\Media;
use AmirVahedix\Media\Services\MediaService;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    public function download(Media $media)
    {
        return MediaService::stream($media);
    }
}
