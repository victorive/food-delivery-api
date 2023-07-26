<?php

namespace App\Models;

use App\Traits\Ulid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory, Ulid;

    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'price',
        'quantity',
        'is_available'
    ];

    protected $hidden = [
        'id',
    ];

    protected $casts = [
        'is_available' => 'boolean'
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
