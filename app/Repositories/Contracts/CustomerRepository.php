<?php

namespace App\Repositories\Contracts;

interface CustomerRepository
{
    public function create(array $attributes);
}
