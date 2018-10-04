<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ItinerarioTour
 *
 * @property int $id
 * @property int $tour_id
 * @property int $dia
 * @property string $contenido
 * @property string $contenido_trad
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItinerarioTour whereContenido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItinerarioTour whereContenidoTrad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItinerarioTour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItinerarioTour whereDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItinerarioTour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItinerarioTour whereTourId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ItinerarioTour whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Tour $tour
 */
class ItinerarioTour extends Model
{
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
