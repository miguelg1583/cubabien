<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AgencyRequest
 *
 * @property int $id
 * @property string $name
 * @property int $autorizada
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereAnualSalesVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereAutorizada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereDBNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereIataNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereOwnerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest wherePhoneNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereTravelPermitFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereTravelPermitFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyRequest whereYearBusiness($value)
 * @mixin \Eloquent
 */
class AgencyRequest extends Model
{
    //
}
