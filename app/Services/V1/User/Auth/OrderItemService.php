<?php

namespace App\Services\V1\User\Auth;

use App\Enums\OrderItemConfirmationStatus;
use App\Repositories\Contracts\OrderItemRepository;
use App\Repositories\Contracts\RestaurantRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderItemService
{
    public function __construct(private OrderItemRepository $orderItemRepository,
                                private RestaurantRepository $restaurantRepository)
    {
    }

    public function getRestaurantOrderItems(int $restaurantId)
    {
        $restaurant = $this->restaurantRepository->findById($restaurantId);

        if (!$restaurant) {
            throw new NotFoundHttpException;
        }

        return $this->restaurantRepository->getRestaurantOrderItems($restaurantId);
    }

    public function acceptOrderItem(string $orderItemUlid)
    {
        $this->findOrderItemByUlid($orderItemUlid);

        return $this->orderItemRepository->update([
            'confirmation_status' => OrderItemConfirmationStatus::ACCEPTED->value
        ], $orderItemUlid);
    }


    public function rejectOrderItem(string $orderItemUlid)
    {
        $this->findOrderItemByUlid($orderItemUlid);

        return $this->orderItemRepository->update([
            'confirmation_status' => OrderItemConfirmationStatus::REJECTED->value
        ], $orderItemUlid);
    }

    public function findOrderItemByUlid(string $orderItemUlid)
    {
        $orderItem = $this->orderItemRepository->findByUlid($orderItemUlid);

        if (!$orderItem) {
            throw new NotFoundHttpException;
        }

        return $orderItem;
    }
}
