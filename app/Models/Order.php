<?php

namespace App\Models;

use App\Enums\OrderDeliveryStatus;
use App\Traits\Ulid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory, Ulid;

    protected $fillable = [
        'customer_id',
        'delivery_agent_id',
        'total_amount',
        'payment_method_id',
        'delivery_status'
    ];

    protected $casts = [
        'delivery_status' => OrderDeliveryStatus::class
    ];

    protected $hidden = [
        'id',
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }


    public function deliveryAgent(): BelongsTo
    {
        return $this->belongsTo(DeliveryAgent::class);
    }


    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}

