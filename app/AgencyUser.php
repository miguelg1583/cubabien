<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\AgencyUser
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $agency_id
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Agency $agency
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyUser whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AgencyUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AgencyUser extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'agency_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
