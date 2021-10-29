<?php


namespace AmirVahedix\Ticket\Models;


use AmirVahedix\Media\Models\Media;
use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Reply extends Model
{
    // region model config
    protected $table = 'ticket_replies';

    protected $fillable = [
        'user_id',
        'ticket_id',
        'media_id',
        'body',
    ];
    // endregion model config

    // region relations
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
    // endregion relations

    // region custom methods
    public function attachmentLink()
    {
        if ($this->media_id) {
            return URL::temporarySignedRoute(
                'media.download',
                now()->addDay(),
                [ 'media' => $this->media_id ]
            );
        }

        return null;
    }
    // endregion custom methods
}
