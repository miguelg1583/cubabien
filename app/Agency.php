<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Agency
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string $email
 * @property string|null $d_b_num
 * @property string|null $phone_num
 * @property int|null $year_business
 * @property string|null $travel_permit_filename
 * @property mixed|null $travel_permit_file
 * @property string|null $iata_num
 * @property string|null $owner_name
 * @property string|null $title
 * @property string|null $anual_sales_volume
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AgencyUser[] $usuarios
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereAnualSalesVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereDBNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereIataNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereOwnerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency wherePhoneNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereTravelPermitFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereTravelPermitFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Agency whereYearBusiness($value)
 * @mixin \Eloquent
 */
class Agency extends Model
{
    public function usuarios()
    {
        return $this->hasMany(AgencyUser::class);
    }
}
