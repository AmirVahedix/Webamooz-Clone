<?php


namespace AmirVahedix\Media\Models;


use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    // region model config
    protected $table = 'media';

    protected $fillable = ['user_id', 'files', 'type', 'filename'];
    // endregion model config
}
