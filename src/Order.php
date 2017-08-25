<?php
namespace Montly;

/**
 * Class Order
 * @package Montly
 */
class Order extends ApiResource
{
    /**
     * Create (post) a new order
     *
     * @param null $order
     * @return mixed
     */
    public static function create($order = null)
    {
        return parent::create($order);
    }
}
