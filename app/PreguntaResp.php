<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PreguntaResp
 *
 * @property int $id
 * @property int $categoria_faq_id
 * @property string $pregunta
 * @property string $pregunta_trad
 * @property string $respuesta
 * @property string $respuesta_trad
 * @property int|null $visitas
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\CategoriaFaq $categoriaFaq
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PreguntaResp whereCategoriaFaqId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PreguntaResp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PreguntaResp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PreguntaResp wherePregunta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PreguntaResp wherePreguntaTrad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PreguntaResp whereRespuesta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PreguntaResp whereRespuestaTrad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PreguntaResp whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PreguntaResp whereVisitas($value)
 * @mixin \Eloquent
 */
class PreguntaResp extends Model
{
    //
    public function categoriaFaq()
    {
        return $this->belongsTo(CategoriaFaq::class);
    }
}
