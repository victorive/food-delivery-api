<?php

namespace App\Models;

use App\Traits\Ulid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class DeliveryAgent extends Authenticatable implements JWTSubject
{
    use HasFactory, Ulid;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'is_available',
        'device_token',
    ];


    protected $hidden = [
        'id',
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_available' => 'boolean',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
