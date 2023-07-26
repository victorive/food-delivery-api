<?php

namespace App\Repositories\Contracts;

interface DeliveryAgentRepository
{
    public function create(array $attributes);

    public function findById(int $deliveryAgentId);

    public function update(array $attributes, $deliveryAgentId);
}
