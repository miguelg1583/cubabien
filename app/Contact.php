<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Date;

/**
 * App\Contact
 *
 * @property int $id
 * @property string $nombre
 * @property string $email
 * @property string $mensaje
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereMensaje($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{
    public function getCreatedAtAttribute($created_at)
    {
        return new Date($created_at);
    }
}
