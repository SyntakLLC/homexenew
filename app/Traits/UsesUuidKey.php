<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UsesUuidKey
{
    protected static function bootUsesUuidKey()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getKeyName()
    {
        return 'uuid';
    }
}
