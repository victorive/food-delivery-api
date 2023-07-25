<?php

namespace App\Models;

use App\Traits\Ulid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Restaurant extends Authenticatable implements JWTSubject
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
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
