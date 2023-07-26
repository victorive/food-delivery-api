<?php

namespace App\Enums;

enum MenuAvailabilityStatus: int
{
    case IN_STOCK = 1;
    case OUT_OF_STOCK = 0;
}
