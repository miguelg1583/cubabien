<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ImagenPub
 *
 * @property int $id
 * @property string $imagen
 * @property string $lugar
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ImagenPub whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ImagenPub whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ImagenPub whereImagen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ImagenPub whereLugar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ImagenPub whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ImagenPub extends Model
{
    protected $fillable = ['imagen', 'lugar'];
}
