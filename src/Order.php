<?php
namespace LeaseCloud;

/**
 * Class Order
 * @package LeaseCloud
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
     * @return object
     */
    public static function cancel($orderId)
    {
        $url = static::classUrl();
        $url = $url . '/' . $orderId . '/cancel';
        list($ret, $code) = parent::staticRequest('post', $url, []);

        return (object)[
            'code' => $code,
            'status' => $code === 200? 'success' : 'failed'
        ];
    }

    /**
     * Tell LeaseCloud that an order is shipped
     *
     * @param string $orderId
     * @param int    $shippedAt Unix timestamp
     * @return object
     */
    public static function shipped($orderId, $shippedAt = 0)
    {
        $url = static::classUrl();
        $url = $url . '/' . $orderId . '/shipped';
        list($ret, $code) = parent::staticRequest('post', $url, [
            'shippedAt' => date('c', $shippedAt ? $shippedAt : time()),
        ]);

        return (object)[
            'code' => $code,
            'status' => $code === 204? 'success' : 'failed'
        ];
    }
}
