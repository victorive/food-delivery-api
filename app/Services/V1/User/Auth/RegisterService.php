<?php

namespace App\Services\V1\User\Auth;

use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\DeliveryAgentRepository;
use App\Repositories\Contracts\RestaurantRepository;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function __construct(private CustomerRepository      $customerRepository,
                                private RestaurantRepository    $restaurantRepository,
                                private DeliveryAgentRepository $deliveryAgentRepository)
    {
    }

    public function registerCustomer(array $formData)
    {
        $formData = $this->prepareFormData($formData);

        return $this->customerRepository->create($formData);
    }

    public function registerRestaurant(array $formData)
    {
        $formData = $this->prepareFormData($formData);

        return $this->restaurantRepository->create($formData);
    }

    public function registerDeliveryAgent(array $formData)
    {
        $formData = $this->prepareFormData($formData);

        return $this->deliveryAgentRepository->create($formData);
    }

    private function prepareFormData(array $formData): array
    {
        return collect($formData)->merge([
            'password' => Hash::make($formData['password'])
        ])->toArray();
    }
}
