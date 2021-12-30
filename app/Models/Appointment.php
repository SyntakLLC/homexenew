<?php

namespace App\Models;

use App\Traits\UsesUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin IdeHelperAppointment
 */
class Appointment extends Model
{
    use UsesUuidKey;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'unique_appt_id',
        'lead_name',
        'user_id',
        'user_name',
        'outcome',
        'start',
        'end',
        'title',
        'description',
        'location',
        'points_left',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
