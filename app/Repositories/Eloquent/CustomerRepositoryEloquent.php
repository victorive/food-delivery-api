<?php

namespace App\Repositories\Eloquent;

use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepository;

class CustomerRepositoryEloquent implements CustomerRepository
{
    public function create(array $attributes)
    {
        return Customer::query()->create($attributes);
    }

    public function findById(int $customerId)
    {
        return Customer::query()->find($customerId);
    }

    public function update(array $attributes, $customerId)
    {
        return tap($this->findById($customerId), function ($customer) use ($attributes) {
            $customer->update($attributes);
        });
    }
}
