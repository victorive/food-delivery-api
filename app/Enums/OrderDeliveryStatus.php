<?php

namespace App\Enums;

enum OrderDeliveryStatus: int
{
    case PENDING = 0;
    case PROCESSING = 1;
    case SHIPPED = 2;
    case OUT_FOR_DELIVERY = 3;
    case DELIVERED = 4;
}
