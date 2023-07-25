<?php

namespace App\Repositories\Eloquent;

use App\Models\Customer;
use App\Models\DeliveryAgent;
use App\Repositories\Contracts\DeliveryAgentRepository;

class DeliveryAgentRepositoryEloquent implements DeliveryAgentRepository
{
    public function create(array $attributes)
    {
        return DeliveryAgent::query()->create($attributes);
    }
}
