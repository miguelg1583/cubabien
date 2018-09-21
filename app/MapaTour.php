<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MapaTour
 *
 * @property int $id
 * @property int $tour_id
 * @property float $latitud
 * @property float $longitud
 * @property string $etiqueta
 * @property string $etiqueta_trad
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MapaTour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MapaTour whereEtiqueta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MapaTour whereEtiquetaTrad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MapaTour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MapaTour whereLatitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MapaTour whereLongitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MapaTour whereTourId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MapaTour whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MapaTour extends Model
{
    //
}
