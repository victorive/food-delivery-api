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
}
