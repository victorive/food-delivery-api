<?php

namespace App\Models;

use App\Enums\OrderItemConfirmationStatus;
use App\Traits\Ulid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory, Ulid;

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'restaurant_id',
        'menu_id',
        'quantity',
        'amount',
        'confirmation_status',
    ];

    protected $hidden = [
        'id',
    ];

    protected $casts = [
        'confirmation_status' => OrderItemConfirmationStatus::class
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
