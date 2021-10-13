<?php


namespace AmirVahedix\Media\Models;


use AmirVahedix\Media\Services\MediaService;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    // region model config
    protected $table = 'media';

    protected $fillable = ['user_id', 'files', 'type', 'filename'];
    // endregion model config

    // region overrides
    protected static function booted()
    {
        static::deleting(function($media) {
            MediaService::delete($media);
        });
        parent::booted();
    }
    // endregion overrides
}
