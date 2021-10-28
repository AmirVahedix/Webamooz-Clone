<?php


namespace AmirVahedix\Ticket\Services;


use AmirVahedix\Media\Models\Media;
use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\Ticket\Models\Ticket;
use AmirVahedix\Ticket\Repositories\ReplyRepo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class ReplyService
{
    public static function store(Model $ticket, string $reply, UploadedFile $attachment = null)
    {
        $media = null;
        if ($attachment) {
            $media = MediaService::privateUpload($attachment);
        }

        return ReplyRepo::store($ticket->id, $reply, $media->id);
    }
}
