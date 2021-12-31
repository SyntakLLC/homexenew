<?php

namespace App\Models;

use App\Traits\UsesUuidKey;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use UsesUuidKey;
    
    protected $fillable = [
        'street1',
        'street2',
        'city',
        'state',
        'postal_code',
        'country',
        'latitude',
        'longitude'
    ];
    
    public function addressable() {
        return $this->morphTo();
    }
}
