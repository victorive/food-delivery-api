<?php

namespace App\Enums;

enum PaymentMethodType: int
{
    case CASH_ON_DELIVERY = 1;
    case STRIPE = 2;
    case PAYPAL = 3;
}
