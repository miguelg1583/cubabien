<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Tour
 *
 * @property int $id
 * @property string $nb
 * @property string|null $nb_trad
 * @property string $introd
 * @property string|null $introd_trad
 * @property int|null $num_dias
 * @property int|null $num_noches
 * @property string|null $salida_dia_trad
 * @property string|null $llegada_dia_trad
 * @property int $activo
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FechaTour[] $fechas
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tour whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tour whereIntrod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tour whereIntrodTrad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tour whereLlegadaDiaTrad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tour whereNb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tour whereNbTrad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tour whereNumDias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tour whereNumNoches($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tour whereSalidaDiaTrad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tour whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ItinerarioTour[] $itinerario
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MapaTour[] $mapa
 * @property-read mixed $cant_itine
 * @property int $visitas
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tour whereVisitas($value)
 */
class Tour extends Model
{
    public function fechas()
    {
        return $this->hasMany(FechaTour::class);
    }

    public function mapa()
    {
        return $this->hasMany(MapaTour::class);
    }

    public function itinerario()
    {
        return $this->hasMany(ItinerarioTour::class)->orderBy('dia');
    }

    public function getNearFecha()
    {
        $diff = 2000000;
        $fecha = new FechaTour();
        foreach ($this->fechas as $fechaTour) {
            $fechaDesde = Carbon::createFromFormat('Y-m-d', $fechaTour->desde);
            if ($fechaDesde > Carbon::now()) {
                $dife = $fechaDesde->diffInDays();
                if ($dife < $diff) {
                    $diff = $dife;
                    $fecha = $fechaTour;
                }
            }
        }
        return $fecha;
    }

    public function getNearCantFecha()
    {
        $sum = 0;
        foreach ($this->fechas as $fechaTour) {
            $fechaDesde = Carbon::createFromFormat('Y-m-d', $fechaTour->desde);
            if ($fechaDesde > Carbon::now()) {
                $sum += 1;
            }
        }
        return $sum;
    }

    public function getAllFechaAfterToday()
    {
        return $this->hasMany(FechaTour::class)->whereDate('desde','>',now())->get();
    }

    public function getCantItineAttribute()
    {
        if($this->itinerario() != null ){
            return $this->itinerario()->count('id');
        }else{
            return 0;
        }
    }
}
