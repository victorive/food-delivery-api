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

    public function findById(int $deliveryAgentId)
    {
        return DeliveryAgent::query()->find($deliveryAgentId);
    }

    public function update(array $attributes, $deliveryAgentId)
    {
        return tap($this->findById($deliveryAgentId), function ($deliveryAgent) use ($attributes) {
            $deliveryAgent->update($attributes);
        });
    }
}
