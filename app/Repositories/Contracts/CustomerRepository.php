<?php

namespace App\Repositories\Contracts;

interface CustomerRepository
{
    public function create(array $attributes);

    public function findById(int $customerId);

    public function update(array $attributes, int $customerId);
}
