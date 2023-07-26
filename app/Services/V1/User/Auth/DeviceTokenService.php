<?php

namespace App\Services\V1\User\Auth;

use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\DeliveryAgentRepository;
use App\Repositories\Contracts\RestaurantRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeviceTokenService
{
    public function __construct(private CustomerRepository      $customerRepository,
                                private RestaurantRepository    $restaurantRepository,
                                private DeliveryAgentRepository $deliveryAgentRepository)
    {
    }
    public function updateCustomerDeviceToken(array $formData, int $customerId)
    {
        $customer = $this->customerRepository->findById($customerId);

        if (!$customer) {

            throw new NotFoundHttpException;
        }

        return $this->customerRepository->update($formData, $customerId);
    }

    public function updateRestaurantDeviceToken(array $formData, int $restaurantId)
    {
        $restaurant = $this->restaurantRepository->findById($restaurantId);

        if (!$restaurant) {

            throw new NotFoundHttpException;
        }

        return $this->restaurantRepository->update($formData, $restaurantId);
    }

    public function updateDeliveryAgentDeviceToken(array $formData, int $deliveryAgentId)
    {
        $deliveryAgent = $this->deliveryAgentRepository->findById($deliveryAgentId);

        if (!$deliveryAgent) {

            throw new NotFoundHttpException;
        }

        return $this->deliveryAgentRepository->update($formData, $deliveryAgentId);
    }
}
