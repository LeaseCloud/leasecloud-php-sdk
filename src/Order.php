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

    /**
     * Get status information about an order
     *
     * @param string $orderId
     * @return mixed
     */
    public static function status($orderId)
    {
        $url = static::classUrl();
        $url = $url . '/' . $orderId . '/status';
        list($ret) = parent::staticRequest('get', $url, []);

        return $ret;
    }

    /**
     * Cancel an order
     *
     * @param string $orderId
     * @return mixed
     */
    public static function cancel($orderId)
    {
        $url = static::classUrl();
        $url = $url . '/' . $orderId . '/cancel';
        list($ret) = parent::staticRequest('post', $url, []);

        return $ret;
    }

}
