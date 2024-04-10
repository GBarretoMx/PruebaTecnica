<?php
declare(strict_types=1);
namespace Chupaprecios\NewSection\Api;

interface OrderByIncrementIdInterface
{

    /**
     * Get For Order
     * @param string $orderId
     * @return mixed
     */
    public function getOrderByIncrementId($orderId);

}
