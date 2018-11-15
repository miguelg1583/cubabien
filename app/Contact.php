<?php

namespace App;

use Carbon\Carbon;
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
 * @property int $atendido
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereAtendido($value)
 */
class Contact extends Model
{
    /**
     * @param Carbon $created_at
     * @return Date
     */
    public function getCreatedAtAttribute($created_at)
    {
        return new Date($created_at);
    }

    /**
     * @param int $atendido
     * @return bool
     */
    public function getAtendidoAttribute($atendido)
    {
        if ($atendido === 0) {
            return false;
        } elseif ($atendido === 1) {
            return true;
        }
        return $atendido;
    }

    /**
     * @param boolean $atendido
     */
    public function setAtendidoAttribute($atendido)
    {
        if ($atendido === true) {
            $this->attributes['atendido'] = 1;
        } else {
            $this->attributes['atendido'] = 0;
        }
    }
}
