<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Ulid
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->ulid = (string) Str::ulid();
        });
    }

}
