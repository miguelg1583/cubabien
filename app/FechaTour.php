<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FechaTour
 *
 * @property int $id
 * @property int $tour_id
 * @property string $desde
 * @property string $hasta
 * @property float|null $precio_s_pax
 * @property float|null $precio_d_pax
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FechaTour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FechaTour whereDesde($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FechaTour whereHasta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FechaTour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FechaTour wherePrecioDPax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FechaTour wherePrecioSPax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FechaTour whereTourId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FechaTour whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FechaTour extends Model
{
    //
}
