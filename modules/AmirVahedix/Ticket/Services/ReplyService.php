<?php


namespace AmirVahedix\Ticket\Services;


use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\Ticket\Repositories\ReplyRepo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class ReplyService
{
    public static function store(Model $ticket, string $reply, UploadedFile $attachment = null)
    {
        $media_id = null;
        if ($attachment)
            $media_id = MediaService::privateUpload($attachment)->id;

        return ReplyRepo::store($ticket->id, $reply, $media_id);
    }
}
